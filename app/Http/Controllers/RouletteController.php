<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouletteController extends Controller
{
    private $validateInputRules = [
        'n1st12' => 'nullable|integer|min:1',
        'n1to18' => 'nullable|integer|min:1',
        'neven' => 'nullable|integer|min:1',
        'n2nd12' => 'nullable|integer|min:1',
        'nred' => 'nullable|integer|min:1',
        'nblack' => 'nullable|integer|min:1',
        'n3rd12' => 'nullable|integer|min:1',
        'nodd' => 'nullable|integer|min:1',
        'n19to36' => 'nullable|integer|min:1',
        'n0' => 'nullable|integer|min:1',
        'n1' => 'nullable|integer|min:1',
        'n2' => 'nullable|integer|min:1',
        'n3' => 'nullable|integer|min:1',
        'n4' => 'nullable|integer|min:1',
        'n5' => 'nullable|integer|min:1',
        'n6' => 'nullable|integer|min:1',
        'n7' => 'nullable|integer|min:1',
        'n8' => 'nullable|integer|min:1',
        'n9' => 'nullable|integer|min:1',
        'n10' => 'nullable|integer|min:1',
        'n11' => 'nullable|integer|min:1',
        'n12' => 'nullable|integer|min:1',
        'n13' => 'nullable|integer|min:1',
        'n14' => 'nullable|integer|min:1',
        'n15' => 'nullable|integer|min:1',
        'n16' => 'nullable|integer|min:1',
        'n17' => 'nullable|integer|min:1',
        'n18' => 'nullable|integer|min:1',
        'n19' => 'nullable|integer|min:1',
        'n20' => 'nullable|integer|min:1',
        'n21' => 'nullable|integer|min:1',
        'n22' => 'nullable|integer|min:1',
        'n23' => 'nullable|integer|min:1',
        'n24' => 'nullable|integer|min:1',
        'n25' => 'nullable|integer|min:1',
        'n26' => 'nullable|integer|min:1',
        'n27' => 'nullable|integer|min:1',
        'n28' => 'nullable|integer|min:1',
        'n29' => 'nullable|integer|min:1',
        'n30' => 'nullable|integer|min:1',
        'n31' => 'nullable|integer|min:1',
        'n32' => 'nullable|integer|min:1',
        'n33' => 'nullable|integer|min:1',
        'n34' => 'nullable|integer|min:1',
        'n35' => 'nullable|integer|min:1',
        'n36' => 'nullable|integer|min:1',
        'n2to11' => 'nullable|integer|min:1',
        'n2to12' => 'nullable|integer|min:1',
        'n2to13' => 'nullable|integer|min:1'
    ];
    private $payoutMultipliers = [
        'n1st12' => 2,
        'n1to18' => 1,
        'neven' => 1,
        'n2nd12' => 2,
        'nred' => 1,
        'nblack' => 1,
        'n3rd12' => 2,
        'nodd' => 1,
        'n19to36' => 1,
        'n0' => 35,
        'n1' => 35,
        'n2' => 35,
        'n3' => 35,
        'n4' => 35,
        'n5' => 35,
        'n6' => 35,
        'n7' => 35,
        'n8' => 35,
        'n9' => 35,
        'n10' => 35,
        'n11' => 35,
        'n12' => 35,
        'n13' => 35,
        'n14' => 35,
        'n15' => 35,
        'n16' => 35,
        'n17' => 35,
        'n18' => 35,
        'n19' => 35,
        'n20' => 35,
        'n21' => 35,
        'n22' => 35,
        'n23' => 35,
        'n24' => 35,
        'n25' => 35,
        'n26' => 35,
        'n27' => 35,
        'n28' => 35,
        'n29' => 35,
        'n30' => 35,
        'n31' => 35,
        'n32' => 35,
        'n33' => 35,
        'n34' => 35,
        'n35' => 35,
        'n36' => 35,
        'n2to11' => 2,
        'n2to12' => 2,
        'n2to13' => 2
    ];
    private $gameRules = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // We could add middleware specific for this controller like so:
        // $this->middleware('auth');
        // For some reason this couldn't go up there straight with the other class members. We have to set
        // gameRules in this fashion.
        $this->gameRules = [
            'n1st12' => function ($nr) { return $nr <= 12; },
            'n1to18' => function ($nr) { return $nr <= 18; },
            'neven' => function ($nr) { return $nr % 2 === 0; },
            'n2nd12' => function ($nr) { return $nr >= 13 && $nr <= 24; },
            'nred' => function ($nr) { return $nr === 1 ||
                $nr === 3 ||
                $nr === 5 ||
                $nr === 7 ||
                $nr === 9 ||
                $nr === 12 ||
                $nr === 14 ||
                $nr === 16 ||
                $nr === 18 ||
                $nr === 19 || 
                $nr === 21 ||
                $nr === 23 ||
                $nr === 25 ||
                $nr === 27 ||
                $nr === 30 ||
                $nr === 32 ||
                $nr === 34 ||
                $nr === 36; },
            'nblack' => function ($nr) { return !$this->gameRules['nred']($nr); },
            'n3rd12' => function ($nr) { return $nr >= 25 && $nr <= 36; },
            'nodd' => function ($nr) { return !$this->gameRules['neven']($nr); },
            'n19to36' => function ($nr) { return !$this->gameRules['n1to18']($nr); },
            'n0' => function ($nr) { return $nr === 0; },
            'n1' => function ($nr) { return $nr === 1; },
            'n2' => function ($nr) { return $nr === 2; },
            'n3' => function ($nr) { return $nr === 3; },
            'n4' => function ($nr) { return $nr === 4; },
            'n5' => function ($nr) { return $nr === 5; },
            'n6' => function ($nr) { return $nr === 6; },
            'n7' => function ($nr) { return $nr === 7; },
            'n8' => function ($nr) { return $nr === 8; },
            'n9' => function ($nr) { return $nr === 9; },
            'n10' => function ($nr) { return $nr === 10; },
            'n11' => function ($nr) { return $nr === 11; },
            'n12' => function ($nr) { return $nr === 12; },
            'n13' => function ($nr) { return $nr === 13; },
            'n14' => function ($nr) { return $nr === 14; },
            'n15' => function ($nr) { return $nr === 15; },
            'n16' => function ($nr) { return $nr === 16; },
            'n17' => function ($nr) { return $nr === 17; },
            'n18' => function ($nr) { return $nr === 18; },
            'n19' => function ($nr) { return $nr === 19; },
            'n20' => function ($nr) { return $nr === 20; },
            'n21' => function ($nr) { return $nr === 21; },
            'n22' => function ($nr) { return $nr === 22; },
            'n23' => function ($nr) { return $nr === 23; },
            'n24' => function ($nr) { return $nr === 24; },
            'n25' => function ($nr) { return $nr === 25; },
            'n26' => function ($nr) { return $nr === 26; },
            'n27' => function ($nr) { return $nr === 27; },
            'n28' => function ($nr) { return $nr === 28; },
            'n29' => function ($nr) { return $nr === 29; },
            'n30' => function ($nr) { return $nr === 30; },
            'n31' => function ($nr) { return $nr === 31; },
            'n32' => function ($nr) { return $nr === 32; },
            'n33' => function ($nr) { return $nr === 33; },
            'n34' => function ($nr) { return $nr === 34; },
            'n35' => function ($nr) { return $nr === 35; },
            'n36' => function ($nr) { return $nr === 36; },
            'n2to11' => function ($nr) { return $nr % 3 === 1; },
            'n2to12' => function ($nr) { return $nr % 3 === 2; },
            'n2to13' => function ($nr) { return $nr % 3 === 0; }
        ];
    }

    /**
     * Show the roulette game view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex()
    {
        return view('menu.roulette.index');
    }

    /**
     * Try your luck and gameble for money in a roulette game.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postIndex(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validateInputRules);

        if ($validator->fails()) {
            $validator->errors()->add('general', 'One or more inputs have wrong values, only positive integers allowed!');
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $char = Auth::user()->character;
        $bets = array_filter($request->except('_token'));
        $winnr = rand(0, 36);
        $payout = 0;

        if (array_sum($bets) < 100) {
            return redirect()->back()->withErrors(['general' => 'Bet has to be at least €100,- combined.']);
        }

        if (array_sum($bets) > 100000) {
            return redirect()->back()->withErrors(['general' => 'Bet can not be more than €100.000,- combined.']);
        }

        if (array_sum($bets) > $char->money) {
            return redirect()->back()->withErrors(['general' => 'Insufficient funds.']);
        }

        foreach($bets as $nr => $bet) {
            // of the total payout first retract any bets, this means $payour can become a negative value
            // this is ok
            $payout -= $bet;
            // then calculate if any bets are winners and add those values to the $payout
            if ($this->gameRules[$nr]($winnr)) {
                // the payout is the multiplier + original bet
                $payout += $this->payoutMultipliers[$nr] * $bet + $bet;
            }
        }
        // we update the characters money with the $payout (which could be a negative, meaning the character
        // just lost all his bets). floor the value, just in case.
        $char->money += floor($payout);
        $char->save();

        if ($payout === 0) {
            return redirect()->back()->withInput()->with('status', 'You didn\'t win, but you didn\'t lose either. The winning number was: '.$winnr.'.');
        }

        if ($payout > 0) {
            return redirect()->back()->withInput()->with('status', 'Yes! You won €'.$payout.'. The winning number was: '.$winnr.'.');
        }

        return redirect()->back()->withInput()->withErrors(['general' => 'You lost it all! Better luck next time. The winning number was: '.$winnr.'.']);
    }

}
