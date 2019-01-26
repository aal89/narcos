<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Character;

class ProfileController extends Controller
{
    /**
     * Show someones profile. Adds an isOwn attribute to the character model to
     * indicate if the model is the players own one (or if you're requesting
     * someone elses, of course the view filters sensitive data).
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getProfile($character)
    {
        $char = Character::findByName($character);
        if ($char) {
            $char->isOwn = false;
            if (Auth::check() && Auth::user()->character->name === $char->name) {
                $char->isOwn = true;
            }
            return view('character.profile')->with('character', $char);
        }
        return redirect('/');
    }
}
