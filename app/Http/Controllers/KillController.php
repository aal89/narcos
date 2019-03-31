<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Character;

class KillController extends Controller
{
    /**
     * Returns character kill view.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getKill()
    {
        return view('menu.kill.index');
    }

    /**
     * Attempt to kill another character.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postKill(Request $request)
    {
        $this->validate($request, [
            'character' => 'required|min:3|max:25|alpha_dash',
            'bullets' => 'required|integer|min:1'
        ]);

        try {
            $char = Auth::user()->character;
            $targetChar = Character::findByName($request->character);
            // check if both characters are in the same country
            // todo: write check
            // bullets needed to 100% kill the target Character, this will be used as the upper bound
            $bulletsNeeded = calculateBulletsNeeded($targetChar->experience);
            // depending on the weapon used by the attacker we calculate the bullets shot and hit
            $bulletsHit = floor($request->bullets * weaponEffectiveness($char->weapon) * bulletEffectiveness());
            // now calculate the life loss (damage) by the percentage of bullets hit against the bullets needed
            $damage = ($bulletsHit / $bulletsNeeded) * 100;
            // withdraw the damage and save target character
            $targetChar->life = max(0, $targetChar->life - $damage);
            $targetChar->save();
            // when the target character is dead send a witness report to somebody random in the country, if
            // somebody witnessed it at all (todo)
            if ($targetChar->life === 0) {
                // todo: send witness report to random character
            } else {
                // in any other case we notify the target character who attacked him. If he could see it at
                // all (todo)
                // todo: send witness report to target character
            }
        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['general' => 'Something went wrong! Try again later.']);
        }

        return redirect()->back();
    }
}
