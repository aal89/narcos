<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BannedController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // We could add middleware specific for this controller like so:
        $this->middleware('is.not.allowed.access');
    }

    /**
     * Decides based on the user' character whether to redirect to the character creation view of the death view. Shows
     * creation view directly if no character was found (new accounts) and shows death view first when the character
     * has died (existing players).
     */
    public function index()
    {
        return view('banned');
    }
}
