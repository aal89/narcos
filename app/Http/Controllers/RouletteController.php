<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RouletteController extends Controller
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
        $this->validate($request, [
            'guess' => 'required|integer|min:1|max:10',
            'bet' => 'required|integer|min:100|max:100000'
        ]);

        $char = Auth::user()->character;

        return redirect()->back();
    }
}
