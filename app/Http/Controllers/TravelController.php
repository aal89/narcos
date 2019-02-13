<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Character;

class TravelController extends Controller
{
    private $countries = [
        'colombia' => 500,
        'puerto rico' => 650,
        'mexico' => 800,
        'united states of america' => 1000
    ];

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
     * Show the banking view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex()
    {
        return view('menu.travel.travel');
    }

    /**
     * Deposits or withdraw money from the bank.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postIndex(Request $request)
    {
        $this->validate($request, [
            'country' => 'required|in:'.implode(',', array_keys($this->countries)),
        ]);

        $char = Auth::user()->character;
        $travelCost = $this->countries[$request->country];

        if ($char->money < $travelCost) {
            return redirect()->back()->withErrors(['country' => 'Insufficient funds.']);
        }

        if ($char->country === $request->country) {
            return redirect()->back()->withErrors(['country' => 'You\'re already in this country.']);
        }

        $char->money -= $travelCost;
        $char->country = $request->country;
        $char->save();

        return redirect()->back();
    }
}
