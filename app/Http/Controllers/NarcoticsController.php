<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

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

    public function postTrade(Request $request, string $narcotic)
    {
        switch($narcotic) {
            case 'weed': return $this->buyWeed($request);
            case 'lsd': return $this->buyLsd($request);
            case 'speed': return $this->buySpeed($request);
            case 'cocaine': return $this->buyCocaine($request);
            default: return $this->buyWeed($request);
        }
    }

    public function buyWeed(Request $request)
    {
        $this->validate($request, [
            'weed' => 'required|integer|min:1'
        ]);
        $isBuying = $request->action === 'buy' ? true : false;

        var_dump($request);

        return null;
    }

    public function buyLsd(Request $request)
    {
        $this->validate($request, [
            'lsd' => 'required|integer|min:1'
        ]);
        $isBuying = $request->action === 'buy' ? true : false;

        var_dump($request);

        return null;
    }

    public function buySpeed(Request $request)
    {
        $this->validate($request, [
            'speed' => 'required|integer|min:1'
        ]);
        $isBuying = $request->action === 'buy' ? true : false;

        var_dump($request);

        return null;
    }

    public function buyCocaine(Request $request)
    {
        $this->validate($request, [
            'cocaine' => 'required|integer|min:1'
        ]);
        $isBuying = $request->action === 'buy' ? true : false;

        var_dump($request);

        return null;
    }
}
