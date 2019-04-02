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
            // check if targetchar is alive
            if ($targetChar->isDead()) {
                return redirect()->back()->withErrors(['general' => 'You can\'t kill somebody who\'s already dead!']);
            }
            // check if you have a gun
            if ($char->weapon === 'none') {
                return redirect()->back()->withErrors(['general' => 'You need a gun first!']);
            }
            // checl if you have the bullets
            if ($char->bullets < $request->bullets) {
                return redirect()->back()->withErrors(['general' => 'You don\'t have that many bullets!']);
            }
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
            }
            // withdraw bullets from char and save
            $char->bullets -= $request->bullets;
            // decide whether to up the kill fail or kill success counters
            $targetChar->isAlive() ? $char->counter->kill_fail += 1 : $char->counter->kill_success += 1;
            $char->counter->save();
            $char->save();
            // roll if witnessed only once. it can mean two things:
            // 1) when the target is dead, it will decide if somebody else witnessed the attack
            // or
            // 2) when the target survived, it will decide if the target saw who did it
            $gotWitnessed = $this->gotWitnessed($withCrew);
            if ($targetChar->isAlive()) {
                // prepare message for char
                $general = 'Your attack failed on '.$targetChar->name.'!';
                // prepare a message for targetChar, depends on whether or not he recognized the attacker
                if ($gotWitnessed) {
                    // append extra notice to general message for char
                    $general .= ' Watch your back, '.$targetChar->name.' recognized you!';
                    systemMessageComposer($targetChar, 'You got attacked!', 'You survived and saw who did it! (<a href="'.url('/profile/'.$char->name).'">'.$char->name.'</a>)');
                } else {
                    // targetChar couldnt really see who attacked him
                    systemMessageComposer($targetChar, 'You got attacked!', 'You survived, but you couldn\'t really see who it was!');
                }
                return redirect()->back()->withErrors(['general' => $general]);
            }
            if ($targetChar->isDead()) {
                // prepare message for char
                $status = 'You outsmarted '.$targetChar->name.' and made him pay!';
                // send witness report to random char in country, iff somebody saw it and this somebody exists (the next query can return null)
                $randomChar = Character::randomActiveInCountry($targetChar->country, $char, $targetChar);
                if ($gotWitnessed && $randomChar) {
                    $status .= ' Somebody saw you do it, run!';
                    systemMessageComposer($randomChar, 'You witnessed a fatal attack!', 'You saw <a href="'.url('/profile/'.$char->name).'">'.$char->name.'</a> attacking <a href="'.url('/profile/'.$targetChar->name).'">'.$targetChar->name.'</a>!');
                    systemMessageComposer($targetChar, 'You got attacked!', 'You were killed! Somebody witnessed your murder.');
                } else {
                    // in any other case we just notify the targetChar, this system message will end up in their mailbox
                    systemMessageComposer($targetChar, 'You got attacked!', 'You were killed! Apparently there were no witnesses.');
                }
                return redirect()->back()->with('status', $status);
            }
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
