<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Character;
use App\Profile;

use App\Facades\NarcoScript;

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
        if ($char->exists()) {
            $char->isOwn = false;
            if (Auth::check() && Auth::user()->character->name === $char->name) {
                $char->isOwn = true;
            }
            return view('character.profile')->with('character', $char);
        }
        return redirect('/');
    }

    /**
     * Creates or updates a profile for the character currently logged in. Redirects to home if successful.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateProfile(Request $request)
    {
        if (Auth::check()) {
            Auth::user()->character->profile()->update([
                'description' => $request->description
            ]);
        }

        return redirect()->back();
    }

    /**
     * Sets profile description to null, does not delete the relationship.
     */
    public function deleteProfile()
    {
        if (Auth::check()) {
            Auth::user()->character->profile()->update([
                'description' => null
            ]);
        }

        return redirect()->back();
    }
}
