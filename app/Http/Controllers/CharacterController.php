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
        $this->middleware('is.allowed.access');
        $this->middleware('user.misses.character');
    }

    /**
     * Decides based on the user' character whether to redirect to the character creation view of the death view. Shows
     * creation view directly if no character was found (new accounts) and shows death view first when the character
     * has died (existing players).
     */
    public function index()
    {
        if(Auth::user()->character()->exists() && Auth::user()->character->isDead())
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
    public function getCreate()
    {
        return view('character.create');
    }

    /**
     * Creates a character for the logged in user. Redirects to home if successful. Back to
     * /character for any error that occurs during creation process.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postCreate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:25|unique:characters',
        ]);

        try {
            if(!isForbiddenCharacterName($request->name)) {
                $char = Auth::user()->character()->create([
                    'name' => $request->name
                ]);
                $char->profile()->create();
                $char->bank()->create();
            } else {
                return redirect()->back()->withErrors(['name' => 'This name is not allowed. Please pick another.']);
            }
        } catch(\Exception $e) {
            // For any error given during the creation of the character handle it by discarding
            // the entire process and begin again by redirecting them back to /character.
            return redirect('/character');
        }

        return redirect('/');
    }

    /**
     * Returns character death view.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getDeath()
    {
        return view('character.death');
    }

    /**
     * Creates a character for the logged in user. Redirects to home if succesful.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postDeath(Request $request)
    {
        Auth::user()->character->release();
        return redirect('/character');
    }
}
