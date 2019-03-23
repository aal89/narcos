<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use App\Character;

class NarcoticsController extends Controller
{
    private $oneDayInMinutes = 3600;
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
            Cache::put('contraband-prices', generateContrabandPrices(), $this->oneDayInMinutes);
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
                    return $this->buyWeed($char, $pricesForCountryOfChar['weed'], $request->weed);
                } else {
                    return $this->sellWeed($char, $pricesForCountryOfChar['weed'], $request->weed);
                }
            case 'lsd': return $this->buyLsd($request, $char);
            case 'speed': return $this->buySpeed($request, $char);
            case 'cocaine': return $this->buyCocaine($request, $char);
            default: return redirect()->back()->withErrors(['general', 'Hmm, you might want to try that again!']);
        }
    }

    public function buyWeed(Character $char, int $pricePerKg, int $kgs)
    {
        if (!$char->contraband->canCarryAdditionalKgs($kgs)) {
            return redirect()->back()->withErrors(['general' => 'You can\'t carry anymore kgs of narcotics.']);
        }

        if (!$char->money < $kgs * $pricePerKg) {
            return redirect()->back()->withErrors(['general' => 'Insufficient funds.']);
        }

        // by this point we know we can carry it and have sufficient funds for it, do the trade
        $char->money -= $kgs * $pricePerKg;
        $char->contraband->weed += $kgs;
        $char->save();
        $char->contraband->save();

        return redirect()->back()->with(['status' => 'You just bought '.$kgs.'kgs of weed for €'.$kgs * $pricePerKg.',-.']);
    }

    public function sellWeed(Character $char, int $pricePerKg, int $kgs)
    {
        if($char->contraband->weed < $kgs) {
            return redirect()->back()->withErrors(['general' => 'You don\'t carry as much.']);
        }

        // by this point we know we actually have the narcotics on-hand, so do the trade
        $char->money += $kgs * $pricePerKg;
        $char->contraband->weed -= $kgs;
        $char->save();
        $char->contraband->save();

        return redirect()->back()->with(['status' => 'You just sold '.$kgs.'kgs of weed for €'.$kgs * $pricePerKg.',-.']);
    }

    public function buyLsd(Request $request, Character $char)
    {
        $this->validate($request, [
            'lsd' => 'required|integer|min:1'
        ]);
        $isBuying = $request->action === 'buy' ? true : false;

        var_dump($request);

        return null;
    }

    public function buySpeed(Request $request, Character $char)
    {
        $this->validate($request, [
            'speed' => 'required|integer|min:1'
        ]);
        $isBuying = $request->action === 'buy' ? true : false;

        var_dump($request);

        return null;
    }

    public function buyCocaine(Request $request, Character $char)
    {
        $this->validate($request, [
            'cocaine' => 'required|integer|min:1'
        ]);
        $isBuying = $request->action === 'buy' ? true : false;

        var_dump($request);

        return null;
    }
}
