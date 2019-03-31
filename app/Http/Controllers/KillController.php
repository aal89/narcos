<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Character;

class KillController extends Controller
{
    private $bringCrewCost = 1000000;
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
            $status = 'You didn\'t kill '.$targetChar->name.', but you did get to him!';
            // check if we're not killing ourselfs
            if ($char->name === $targetChar->name) {
                return redirect()->back()->withErrors(['general' => 'You can\'t kill yourself!']);
            }
            // check if character has enough money if the bring a crew option was set
            if ($request->crew === 'on' && $char->money < $this->bringCrewCost) {
                return redirect()->back()->withErrors(['general' => 'Insufficient funds to bring a crew.']);
            }
            // check if both characters are in the same country
            if ($char->country !== $targetChar->country) {
                return redirect()->back()->withErrors(['general' => 'You can\'t seem to find '.$targetChar->name.', are you in the same country?']);
            }
            // bullets needed to 100% kill the target Character, this will be used as the upper bound
            $bulletsNeeded = calculateBulletsNeeded($targetChar->experience);
            // depending on the weapon used by the attacker we calculate the bullets shot and hit
            $bulletsHit = floor($request->bullets * weaponEffectiveness($char->weapon) * bulletEffectiveness());
            // now calculate the life loss (damage) by the percentage of bullets hit against the bullets needed
            $damage = ($bulletsHit / $bulletsNeeded) * 100;
            // withdraw the damage and save target character
            $targetChar->life = max(0, $targetChar->life - $damage);
            $targetChar->save();
            // withdraw cost of crew from attacker if he used the option
            $withCrew = $request->crew === 'on';
            if ($withCrew) {
                $char->money -= $this->bringCrewCost;
                $char->save();
            }
            // when the target character is dead send a witness report to somebody random in the country, if
            // somebody witnessed it at all
            $gotWitnessed = $this->gotWitnessed($withCrew);
            if ($targetChar->life === 0 && $gotWitnessed) {
                $status = 'You outsmarted '.$targetChar->name.' and made him pay. Somebody witnessed this murder!';
                // todo: send witness report to random char in country
            } else if ($gotWitnessed) {
                // in any other case we notify the target character who got attacked, iff he could see it
                $status .= ' Watch your back, '.$targetChar->name.' recognized you!';
                // todo: send witness report to 'target' (target survived and saw who did it)
            }
            return redirect()->back()->with('status', $status);
        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['general' => 'I can\'t seem to find '.$request->character.'.']);
        }
    }

    /**
     * Returns true or false based on randomness. The chance is 50% by default it
     * returns true. Inflated chances decrease the chance to 20% to return true.
     * 
     * @param bool $inflated 
     */
    private function gotWitnessed(bool $inflated)
    {
        $p = rand(0, 99);
        $cutoff = $inflated ? 20 : 50;
        if ($p < $cutoff) {
            return true;
        }
        return false;
    }
}
