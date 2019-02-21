<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    private $sellRate = 0.75;

    private $prices = [
        'none' => 0,
        'motor' => 1200,
        'boat' => 24000,
        'plane' => 105000,
    ];

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
     * Show the store view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex()
    {
        return view('menu.store.index');
    }

    /**
     * Buy an asset from the store and update characters money and status.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postIndex(Request $request)
    {
        switch($request->action)
        {
            case 'buy': return $this->buy($request);
            case 'sell': return $this->sell($request);
            default: return redirect()->back()->withErrors(['asset' => 'Hmm, you might have to try that again.']);
        }
    }

    private function sell(Request $request)
    {
        $this->validate($request, [
            'asset' => 'required|in:'.implode(',', array_keys($this->prices)),
        ]);

        $char = Auth::user()->character;
        $assetCost = $this->prices[$request->asset];

        if ($char->transport !== $request->asset) {
            return redirect()->back()->withErrors(['asset' => 'You don\'t own this type of vehicle.']);
        }

        $char->money += floor($assetCost * $this->sellRate);
        $char->transport = 'none';
        $char->save();

        return redirect()->back()->with(['status' => 'You just sold your property.']);
    }

    private function buy(Request $request)
    {
        $this->validate($request, [
            'asset' => 'required|in:'.implode(',', array_keys($this->prices)),
        ]);

        $char = Auth::user()->character;
        $currentVehicleValue = $this->prices[$char->transport];
        $assetCost = $this->prices[$request->asset];

        // Adding the currentVehicleValue first is equivalent to selling the current vehicle first
        // then buying the new asset. This is only saved when all conditions are met.
        $char->money += floor($currentVehicleValue * $this->sellRate);

        if ($char->transport === $request->asset) {
            return redirect()->back()->withErrors(['asset' => 'You already own this type of vehicle.']);
        }

        if ($char->money < $assetCost) {
            return redirect()->back()->withErrors(['asset' => 'Insufficient funds.']);
        }

        $char->money -= $assetCost;
        $char->transport = $request->asset;
        $char->save();

        return redirect()->back()->with(['status' => 'You just bought a '.$char->transport]);
    }
}
