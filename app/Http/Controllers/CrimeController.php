<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CrimeController extends Controller
{
    private $availableCrimes = [1, 2, 3];
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
     * Show the trivial crime view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex()
    {
        $char = Auth::user()->character;
        return view('menu.trivial-crime.index')->with(['count' => $char->counter->trivial_crime]);
    }

    /**
     * Commit a crime.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postIndex(Request $request)
    {
        $this->validate($request, [
            'crime' => 'required|in:'.implode(',', $this->availableCrimes),
        ]);

        $char = Auth::user()->character;
        $crimeCount = $char->counter->trivial_crime;
        $travelCost = $this->countries[$request->country];

        if (!$char->can()->trivialCrime()) {
            return redirect()->back()->withErrors(['general' => 'You have to wait untill you can travel again; '.$char->can()->trivialCrimeInMinutes().' minutes left.']);
        }

        $char->money += 10;
        $char->experience += 10;
        $char->counter->trivial_crime += 1;
        $char->can()->resetTrivialCrime();
        $char->counter->save();
        $char->save();

        return redirect()->back()->with(['status' => 'You just traveled to 10, you can travel again in '.$char->can()->trivialCrimeInMinutes().' minutes.']);
    }
}
