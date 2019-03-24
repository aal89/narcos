<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use App\Character;

class NarcoticsController extends Controller
{
    private $oneDayInMinutes = 3600;
    private $oneHourInMinutes = 60;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // We could add middleware specific for this controller like so:
    }

    /**
     * Safely retrieves current contraband prices. If none are set it generates one and returns those prices.
     */
    private function getCurrentPrices()
    {
        // todo: probably refactor this, this logic is in two places now (here and in the Kernel class where schedules are)
        if (!Cache::has('contraband-prices')) {
            Cache::put('contraband-prices', generateContrabandPrices(), $this->oneDayInMinutes + $this->oneHourInMinutes);
        }
        return Cache::get('contraband-prices');
    }

    /**
     * Show the narcotics trade index view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex()
    {
        $char = Auth::user()->character;
        $pricesForCountryOfChar = $this->getCurrentPrices()[$char->country];
        $carryCapacity = $char->contraband->carryCapacity();
        return view('menu.narcotics-trade.index')->with('prices', $pricesForCountryOfChar)->with('carryCapacity', $carryCapacity);
    }

    /**
     * Request handler for a trade request of a specific narcotic.
     */
    public function postTrade(Request $request, string $narcotic)
    {
        $char = Auth::user()->character;
        $isBuying = $request->action === 'buy' ? true : false;
        $pricesForCountryOfChar = $this->getCurrentPrices()[$char->country];
        switch($narcotic) {
            case 'weed':
                $this->validate($request, ['weed' => 'required|integer|min:1']);
                if ($isBuying) {
                    return $this->buy($char, $pricesForCountryOfChar['weed'], $request->weed, 'weed');
                } else {
                    return $this->sell($char, $pricesForCountryOfChar['weed'], $request->weed, 'weed');
                }
            case 'lsd':
                $this->validate($request, ['lsd' => 'required|integer|min:1']);
                if ($isBuying) {
                    return $this->buy($char, $pricesForCountryOfChar['lsd'], $request->lsd, 'lsd');
                } else {
                    return $this->sell($char, $pricesForCountryOfChar['lsd'], $request->lsd, 'lsd');
                }
            case 'speed': 
                $this->validate($request, ['speed' => 'required|integer|min:1']);
                if ($isBuying) {
                    return $this->buy($char, $pricesForCountryOfChar['speed'], $request->speed, 'speed');
                } else {
                    return $this->sell($char, $pricesForCountryOfChar['speed'], $request->speed, 'speed');
                }
            case 'cocaine': 
                $this->validate($request, ['cocaine' => 'required|integer|min:1']);
                if ($isBuying) {
                    return $this->buy($char, $pricesForCountryOfChar['cocaine'], $request->cocaine, 'cocaine');
                } else {
                    return $this->sell($char, $pricesForCountryOfChar['cocaine'], $request->cocaine, 'cocaine');
                }
            default: return redirect()->back()->withErrors(['general', 'Hmm, you might want to try that again!']);
        }
    }

    public function buy(Character $char, int $pricePerKg, int $kgs, string $narcotic)
    {
        if (!$char->contraband->canCarryAdditionalKgs($kgs)) {
            return redirect()->back()->withErrors(['general' => 'You can\'t carry that much.']);
        }

        if ($char->money < $kgs * $pricePerKg) {
            return redirect()->back()->withErrors(['general' => 'Insufficient funds.']);
        }

        // by this point we know we can carry it and have sufficient funds for it, do the trade
        $char->money -= $kgs * $pricePerKg;
        $char->contraband->{$narcotic} += $kgs;
        $char->save();
        $char->contraband->save();

        return redirect()->back()->with(['status' => 'You just bought '.$kgs.'kgs of '.$narcotic.' for €'.$kgs * $pricePerKg.',-.']);
    }

    public function sell(Character $char, int $pricePerKg, int $kgs, string $narcotic)
    {
        if($char->contraband->{$narcotic} < $kgs) {
            return redirect()->back()->withErrors(['general' => 'You don\'t carry as much.']);
        }

        // by this point we know we actually have the narcotics on-hand, so do the trade
        $char->money += $kgs * $pricePerKg;
        $char->contraband->{$narcotic} -= $kgs;
        $char->save();
        $char->contraband->save();

        return redirect()->back()->with(['status' => 'You just sold '.$kgs.'kgs of '.$narcotic.' for €'.$kgs * $pricePerKg.',-.']);
    }
}
