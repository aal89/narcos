<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NumbersGameController extends Controller
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
        return redirect('/numbers-game');
    }
}
