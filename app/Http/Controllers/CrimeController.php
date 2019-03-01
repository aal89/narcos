<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CrimeController extends Controller
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
    public function postIndex()
    {
        $char = Auth::user()->character;
        return view('menu.trivial-crime.index')->with(['count' => $char->counter->trivial_crime]);
    }
}
