<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\OrganizedCrime;
use App\Character;

class OrganizedCrimeController extends Controller
{
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
        switch ($position) {
            case 'driver': return $this->inviteDriver($request);
            case 'spotter': return $this->inviteSpotter($request);
            default: return redirect()->back();
        }
    }

    private function inviteDriver(Request $request)
    {
        try {
            $char = Character::findByName($request->driver);
            $party = OrganizedCrime::getParty(Auth::user()->character);
            return view('menu.organized-crime.index')->with(['party' => $party]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([ 'driver' => 'No character found for '.$request->driver ]);
        }
    }

    private function inviteSpotter(Request $request)
    {
        $char = Character::findByName($request->spotter);
        $party = OrganizedCrime::getParty(Auth::user()->character);
        return view('menu.organized-crime.index')->with(['party' => $party]);
    }
}
