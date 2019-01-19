<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // We could add middleware specific for this controller like so:
        $this->middleware('user.misses.character');
    }

    /**
     * Decides based on the user' character whether to redirect to the character creation view of the death view. Shows
     * creation view directly if no character was found (new accounts) and shows death view first when the character
     * has died (existing players).
     */
    public function index()
    {
        if(Auth::user()->character()->exists() && Auth::user()->character()->life === 0)
        {
            return redirect('/character/death');
        }
        return redirect('/character/create');
    }

    /**
     * Returns character creation view.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('character.create');
    }

    /**
     * Returns character death view.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function death()
    {
        return view('character.death');
    }
}
