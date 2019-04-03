<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NumbersGameController extends Controller
{
    private $winMultiplier = 10;
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
     * Show the numbers game view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex()
    {
        return view('menu.numbers-game.index');
    }

    /**
     * Try your luck and gameble for money in a numbers game.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postIndex(Request $request)
    {
        $this->validate($request, [
            'guess' => 'required|integer|min:1|max:10',
            'bet' => 'required|integer|min:100|max:100000'
        ]);

        $char = Auth::user()->character;

        if ($char->money < $request->bet) {
            return redirect()->back()->withErrors(['general' => 'Insufficient funds.']);
        }
        // roll winning number
        $p = rand(1, 10);
        $win = $request->bet * $this->winMultiplier;
        $char->money -= $request->bet;
        $char->counter->numbers_game += 1;
        $char->counter->save();
        $char->save();

        if ($p === (int)$request->guess) {
            $char->money += $win;
            $char->save();
            return redirect()->back()->withInput()->with('status', 'Yes! You won €'.$win.'.');
        }

        return redirect()->back()->withInput()->withErrors(['general' => 'Too bad, it was '.$p.'.']);
    }
}
