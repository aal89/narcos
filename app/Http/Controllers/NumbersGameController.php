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
        $char->counter->numbers_game += 1;

        if ($p === (int)$request->guess) {
            $win = $request->bet * $this->winMultiplier;
            // return original bet with the winnings
            $char->money += $win + $request->bet;
            $char->counter->numbers_game_win += $win;
            $char->counter->save();
            $char->save();
            return redirect()->back()->withInput()->with('status', 'Yes! You won €'.$win.'.');
        } else {
            $char->money -= $request->bet;
            $char->counter->numbers_game_loss += $request->bet;
            $char->counter->save();
            $char->save();
            return redirect()->back()->withInput()->withErrors(['general' => 'Too bad, it was '.$p.'.']);
        }
    }
}
