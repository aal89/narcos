<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\OrganizedCrime;
use App\Character;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrganizedCrimeController extends Controller
{
    private $ocInviteMessage = 'Would you like to join me to do an organized crime attempt?<br><a href="#" class="btn btn-link">Join</a>';
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
     * Creates and sends an in-game message to some player as an invite to an organized crime attempt.
     *
     * @param Character $inviter Origin of the message.
     * @param Character $invitee Recipient of the message.
     * @param string $position The spot to get when the invite is accepted.
     */
    private function sendOrganizedCrimeInvite(Character $inviter, Character $invitee, string $position)
    {
        messageComposer($inviter->id, $invitee->id, 'I need a '.$position.'!', $this->ocInviteMessage, true);
    }

    /**
     * Show the organized crime view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex()
    {
        $party = OrganizedCrime::getParty(Auth::user()->character);
        return view('menu.organized-crime.index')->with(['party' => $party]);
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
