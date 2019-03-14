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
        return view('menu.trivial-crime.index')->with([
            'crime1Percentage' => calculateCrimePercentage($char->counter->trivial_crime, 1),
            'crime2Percentage' => calculateCrimePercentage($char->counter->trivial_crime, 2),
            'crime3Percentage' => calculateCrimePercentage($char->counter->trivial_crime, 3)
        ]);
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

        if (!$char->can()->trivialCrime()) {
            return redirect()->back()->withErrors(['general' => 'You have to wait until you can commit crimes again; '.$char->can()->trivialCrimeInSeconds().' seconds left.']);
        }

        $crimePercentage = calculateCrimePercentage($char->counter->trivial_crime, $request->crime);
        // very simple and naive calculation, use gaussian mixture in the future?
        $p = rand(0,99);

        // update the character already, except for loot handling this is state depend (successful crime or not)
        $loot = calculateCrimeLoot($request->crime);
        $exp = calculateCrimeExperience($request->crime);
        $char->experience += $exp;
        $char->counter->trivial_crime += 1;
        $char->can()->resetTrivialCrime();

        if ($p >= $crimePercentage) {
            $char->counter->save();
            $char->save();
            return redirect()->back()->withErrors(['general' => 'Ah! You failed try again in '.$char->can()->trivialCrimeInSeconds().' seconds.']);
        }
        
        $char->money += $loot;
        $char->counter->save();
        $char->save();

        return redirect()->back()->with(['status' => 'Success! You managed to take €'.$loot.',-']);
    }
}
