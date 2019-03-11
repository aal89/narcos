<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\OrganizedCrime;
use App\Character;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrganizedCrimeController extends Controller
{
    private $inviteExpireInSeconds = 300;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // We could add middleware specific for this controller like so:
        // $this->middleware('auth');
    }

    /**
     * Creates a cached secret and sends an in-game message to a player as an invite to an organized crime attempt.
     * The cached secret is used as a mechanism to validate the invites. An invite is valid for 5 minutes, expires
     * afterwards.
     *
     * @param Character $inviter Origin of the message.
     * @param Character $invitee Recipient of the message.
     * @param string $position The spot to get when the invite is accepted.
     */
    private function sendOrganizedCrimeInvite(Character $inviter, Character $invitee, string $position)
    {
        // In the cache we save a key like: oc-invite-charactername-d6s4d5f4w55 which indicates the invitee character and the secret
        // for value we store who invited the invitee and for what position. Expires after some time. Iff the invitee uses the link
        // with the secret within the expiration time we can be sure the invite is real and sent by the system.
        $secret = md5(rand(0, 1000000));
        Cache::put('oc-invite-'.$invitee->name.'-'.$secret, [$inviter->name, $position], $this->inviteExpireInSeconds);
        $ocInviteMessage = 'Would you like to join me to do an organized crime attempt?<br>
        <a href="/organized-crime/join/'.$secret.'" class="btn btn-link">Join</a><br>
        <i><small>This invite expires in '.($this->inviteExpireInSeconds/60).' minutes.</small></i>';
        messageComposer($inviter->id, $invitee->id, 'I need a '.$position.'!', $ocInviteMessage, true);
    }

    /**
     * Show the organized crime view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex()
    {
        $char = Auth::user()->character;
        $party = OrganizedCrime::getParty($char);
        return view('menu.organized-crime.index')->with(['party' => $party]);
    }

    /**
     * Attempts to join (or create) a party associated with the secret.
     */
    public function getJoin(Request $request, string $secret)
    {
        // use pull, this way the cached value will be discarded immediately, rendering the invite invalid (use once only)
        $char = Auth::user()->character;
        $invite = Cache::pull('oc-invite-'.$char->name.'-'.$secret);
        if ($invite) {
            $char = Auth::user()->character;
            $inviter = Character::findByName($invite[0]);
            $position = $invite[1];
            // once the invite is valid we have to do a couple of checks, firstly:
            if (!OrganizedCrime::canJoin($char)) {
                // if we cant join a party notify the user and stop setting up the party
                return redirect('/organized-crime')->withErrors([ 'general' => 'You\'re already enrolled in another party, leave that one first.' ]);
            }
            // Then we are checking if the party of the inviter exists, if not we create one, if yes we will check for vacancy
            // on our position, if that one passes, we join the party. Fails otherwise.
            $inviterParty = OrganizedCrime::getParty($inviter);
            if ($inviterParty) {
                if ($inviterParty->$position === null) {
                    $inviterParty->{$position.'_id'} = $char->id;
                    $inviterParty->save();
                    return redirect('/organized-crime')->with(['status' => 'You have joined as a '.$position.'!' ]);
                }
                return redirect('/organized-crime')->withErrors([ 'general' => 'The spot '.$position.' has already been taken by somebody else!' ]);
            } else {
                // create a party with the leader
                $party = new OrganizedCrime();
                $party->robber_id = $inviter->id;
                $party->{$position.'_id'} = $char->id;
                $party->save();
                return redirect('/organized-crime')->with([ 'status' => 'You have joined as a '.$position.'!' ]);
            }
        }
        // the invite no longer exists, invalid, notify the user
        return redirect('/organized-crime')->withErrors([ 'general' => 'This invite is no longer valid, ask for a new one.' ]);
    }

    /**
     * Sends an invite to some character.
     *
     * @param  string  $position
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postInvite(Request $request, string $position)
    {
        // only the party leader can send invitations (which requires a minimum rank of Lieutenant)
        // todo: same todo as below, regarding the formalisation of these experience magic numbers
        if (Auth::user()->character->experience < 10000) {
            return redirect()->back()->withErrors([ 'general' => 'You have to be at least a Lieutenant in order to send invites.' ]);
        }
        $party = OrganizedCrime::getParty(Auth::user()->character);
        switch ($position) {
            case 'driver': return $this->inviteDriver($request, $party);
            case 'spotter': return $this->inviteSpotter($request, $party);
            default: return redirect()->back()->with([ 'party' => $party ]);
        }
    }

    private function inviteDriver(Request $request, OrganizedCrime $party = null)
    {
        try {
            $char = Character::findByName($request->driver);
            // since driver's lowest requirement is Low-life (the rank you start with) we just can send the invitation straight away
            $this->sendOrganizedCrimeInvite(Auth::user()->character, $char, 'driver');
            return redirect()->back()->with(['status' => 'Invitation to '.$char->name.' sent!', 'party' => $party]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([ 'driver' => 'No character found for '.$request->driver ]);
        }
    }

    private function inviteSpotter(Request $request, OrganizedCrime $party = null)
    {
        try {
            $char = Character::findByName($request->spotter);
            // if characters exp is lower than 1000 (Hitman rank)
            // todo: formalize this and abstract away these magic numbers, ideally we want to say something like this:
            // if ($char->rank() < Rank.HITMAN)
            if ($char->experience < 1000) {
                throw new \Exception($char->name.' has not reached the minimum rank of Hitman yet.');
            }
            $this->sendOrganizedCrimeInvite(Auth::user()->character, $char, 'spotter');
            return redirect()->back()->with(['status' => 'Invitation to '.$char->name.' sent!', 'party' => $party]);
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors([ 'spotter' => 'No character found for '.$request->spotter ]);
        } catch(\Exception $e) {
            return redirect()->back()->withErrors([ 'spotter' => $e->getMessage() ]);
        }
    }
}
