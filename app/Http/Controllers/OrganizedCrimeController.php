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
    private $inviteExpireInMinutes = 240;
    private $driverShare = 0.2;
    private $spotterShare = 0.3;
    private $robberShare = 0.5;
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
        if (!$char->can()->organizedCrime()) {
            return redirect('/organized-crime')->withErrors([ 'general' => 'You\'re laying low, you\'ve recently already committed organized crime. Wait for '.$char->can()->organizedCrimeInMinutes().' more minutes.' ]);
        }
        $invite = Cache::pull('oc-invite-'.$char->name.'-'.$secret);
        // check if we dont have a cooldown and the invite is valid
        if ($invite) {
            $inviter = Character::findByName($invite[0]);
            // check if the inviting party also can do an oc attempt
            if (!$inviter->can()->organizedCrime()) {
                return redirect('/organized-crime')->withErrors([ 'general' => $inviter->name.' is laying low, you can\'t group with this person right now.' ]);
            }
            $char = Auth::user()->character;
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
                    messageComposer($char->id, $inviter->id, 'I\'m your '.$position.'!', 'Let\'s do this!', true);
                    return redirect('/organized-crime')->with(['status' => 'You have joined as a '.$position.'!' ]);
                }
                return redirect('/organized-crime')->withErrors([ 'general' => 'The spot '.$position.' has already been taken by somebody else!' ]);
            } else {
                // create a party with the leader
                $party = new OrganizedCrime();
                $party->robber_id = $inviter->id;
                $party->{$position.'_id'} = $char->id;
                $party->save();
                messageComposer($char->id, $inviter->id, 'I\'m your '.$position.'!', 'Let\'s do this!', true);
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
        $char = Auth::user()->character;
        // only the party leader can send invitations (which requires a minimum rank of Lieutenant)
        // todo: same todo as below, regarding the formalisation of these experience magic numbers
        if ($char->experience < 10000) {
            return redirect()->back()->withErrors([ 'general' => 'You have to be at least a Lieutenant in order to send invites.' ]);
        }
        // and the party leader may not be on a cooldown!
        if (!$char->can()->organizedCrime()) {
            return redirect()->back()->withErrors([ 'general' => 'You\'re laying low, you\'ve recently already committed organized crime. Wait for '.$char->can()->organizedCrimeInMinutes().' more minutes.' ]);
        }
        // and you cannot invite yourself
        if (strtolower($char->name) === strtolower($request->$position ?? $char->name)) {
            return redirect()->back()->withErrors([ 'general' => 'You cannot invite yourself.' ]);
        }
        $party = OrganizedCrime::getParty($char);
        switch ($position) {
            case 'driver': return $this->inviteDriver($request, $party);
            case 'spotter': return $this->inviteSpotter($request, $party);
            default: return redirect()->back()->with([ 'party' => $party ]);
        }
    }

    /**
     * Attempts to remove a given character from it's party.
     */
    public function postRemove(Request $request, string $character)
    {
        try {
            $givenCharacter = Character::findByName($character);
            $givenCharacterParty = OrganizedCrime::getParty($givenCharacter);
            if (!$givenCharacterParty) {
                throw new \Exception('No party found.');
            }
            $loggedCharacter = Auth::user()->character;
            // We may only remove someone of a party when it is ourself, or when we are the team leader
            if ($givenCharacter->name === $loggedCharacter->name || $givenCharacterParty->robber->name === $loggedCharacter->name) {
                $position = $this->getPosition($givenCharacter, $givenCharacterParty);
                $givenCharacterParty->{$position.'_id'} = null;
                $givenCharacterParty->save();
            }
            return redirect()->back();
        } catch(\Exception $e) {
            return redirect()->back()->withErrors([ 'general' => 'Could not remove character '.$character.' from the party.' ]);
        }
    }

    /**
     * Attempts to do a organized crime.
     */
    public function postAttempt()
    {
        $char = Auth::user()->character;
        $party = OrganizedCrime::getParty($char);
        // check if the party is full and you're the leader
        if($party->driver && $party->spotter && $party->robber && $party->robber->name === $char->name) {
            // check if all the party members are in the same country as the leader (robber)
            if ($party->robber->country !== $party->driver->country || $party->robber->country !== $party->spotter->country) {
                return redirect('/organized-crime')->withErrors([ 'general' => 'Your party is missing! Get everyone to your location before attempting the robbery.' ]);
            }
            // set cooldown for all characters straight away
            $party->robber->can()->resetOrganizedCrime();
            $party->driver->can()->resetOrganizedCrime();
            $party->spotter->can()->resetOrganizedCrime();
            // todo: get rid of the hardcoded 65% probability for organized crimes
            $p = rand(0, 99);
            if ($p < 65) {
                // succes, we notify the robber straight away, the others we send a message to
                // also update the characters exp and money
                $loot = calculateOrganizedCrimeLoot();
                $money = $loot[0];
                $exp = $loot[1];

                $robbersTake = floor($money * $this->robberShare);
                $driversTake = floor($money * $this->driverShare);
                $spottersTake = floor($money * $this->spotterShare);

                $party->robber->experience += $exp;
                $party->robber->money += $robbersTake;
                $party->robber->counter->organized_crime += 1;
                $party->driver->experience += $exp;
                $party->driver->money += $driversTake;
                $party->driver->counter->organized_crime += 1;
                $party->spotter->experience += $exp;
                $party->spotter->money += $spottersTake;
                $party->spotter->counter->organized_crime += 1;
                
                $party->robber->save();
                $party->robber->counter->save();
                $party->driver->save();
                $party->driver->counter->save();
                $party->spotter->save();
                $party->spotter->counter->save();

                messageComposer($party->robber->id, $party->driver->id, 'We did it!', 'I took a total of €'.$money.'. You got: €'.$driversTake.'.', true);
                messageComposer($party->robber->id, $party->spotter->id, 'We did it!', 'I took a total of €'.$money.'. You got: €'.$spottersTake.'.', true);
                $party->delete();
                return redirect()->back()->with([ 'status' => 'Oh yes! You took €'.$money.' (your take €'.$robbersTake.').' ]);
            } else {
                // fail, we notify the robber straight away, the others we send a message to. also disband the party
                // you do get exp when a oc fails
                $exp = calculateOrganizedCrimeLoot()[1];

                $party->robber->experience += $exp;
                $party->robber->counter->organized_crime += 1;
                $party->driver->experience += $exp;
                $party->driver->counter->organized_crime += 1;
                $party->spotter->experience += $exp;
                $party->spotter->counter->organized_crime += 1;

                $party->robber->save();
                $party->robber->counter->save();
                $party->driver->save();
                $party->driver->counter->save();
                $party->spotter->save();
                $party->spotter->counter->save();

                messageComposer($party->robber->id, $party->driver->id, 'We failed', 'I couldn\'t take anything, we got nothing. Lay low for a while.', true);
                messageComposer($party->robber->id, $party->spotter->id, 'We failed', 'I couldn\'t take anything, we got nothing. Lay low for a while.', true);
                $party->delete();
                return redirect()->back()->withErrors([ 'general' => 'Ah! Too bad, this attempt failed. Try again in 6hrs.' ]);
            }
        }
        return redirect()->back()->withErrors([ 'general' => 'The party isn\'t ready yet.' ]);
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
        Cache::put('oc-invite-'.$invitee->name.'-'.$secret, [$inviter->name, $position], $this->inviteExpireInMinutes);
        $ocInviteMessage = 'Would you like to join me to do an organized crime attempt?<br>
        <a href="/organized-crime/join/'.$secret.'" class="btn btn-link">Join</a><br>
        <i><small>This invite expires in '.($this->inviteExpireInMinutes).' minutes.</small></i>';
        messageComposer($inviter->id, $invitee->id, 'I need a '.$position.'!', $ocInviteMessage, true);
    }

    /**
     * Gets the position for a character in a party.
     * @return string
     */
    private function getPosition(Character $char, OrganizedCrime $party)
    {
        if ($party->driver && $party->driver->name === $char->name) {
            return 'driver';
        }
        if ($party->spotter && $party->spotter->name === $char->name) {
            return 'spotter';
        }
        if ($party->robber && $party->robber->name === $char->name) {
            return 'robber';
        }
    }
}
