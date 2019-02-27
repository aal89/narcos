<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Character;

class OnlineController extends Controller
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
     * Show the online-players view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex()
    {
        $onlineCharacters = [];
        foreach (Character::all() as $character) {
            if (Cache::has('user-is-online-' . $character->id)) {
                $onlineCharacters[] = $character->name;
            }
        }
        return view('menu.online-players.index')->with(['onlineCharacters' => $onlineCharacters]);
    }
}
