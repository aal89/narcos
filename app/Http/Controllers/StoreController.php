<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class StoreController extends Controller
{
    private $oneDayInMinutes = 3600;
    private $sellRate = 0.75;
    private $vehiclePrices = [
        'none' => 0,
        'motor' => 1200,
        'boat' => 24000,
        'plane' => 105000,
    ];
    private $weaponPrices = [
        'none' => 0,
        'glock' => 4000,
        'shotgun' => 10000,
        'ak-47' => 35000,
        'm-16' => 75000
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
        $bullets = 0;
        $cost = 0;
        if (Cache::has('daily-bullets-quantity') && Cache::has('daily-bullets-cost')) {
            $bullets = Cache::get('daily-bullets-quantity');
            $cost = Cache::get('daily-bullets-cost');
        }
        return view('menu.store.index')->with(['bulletQuantity' => $bullets, 'bulletCost' => $cost]);
    }

    /**
     * Buy a vehicle from the store and update characters money and status.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postTransport(Request $request)
    {
        switch($request->action)
        {
            case 'buy': return $this->buyTransport($request);
            case 'sell': return $this->sellTransport($request);
            default: return redirect()->back()->withErrors(['general' => 'Hmm, you might have to try that again.']);
        }
    }

    /**
     * Buy a weapon from the store and update characters money and status.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postWeaponry(Request $request)
    {
        switch($request->action)
        {
            case 'buy': return $this->buyWeapon($request);
            case 'sell': return $this->sellWeapon($request);
            default: return redirect()->back()->withErrors(['general' => 'Hmm, you might have to try that again.']);
        }
    }

    /**
     * Buy bullets from the store and update characters money and status.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postBullets(Request $request)
    {
        // todo: this section should be based on cache locks, therefore we should
        // switch over to memcached or redis to make use of such locking, for now
        // ordinary hacking in cache with possibilities for race conditions

        $this->validate($request, [
            'amount' => 'required|integer|min:1',
        ]);

        if (Cache::has('daily-bullets-quantity') && Cache::has('daily-bullets-cost')) {
            $char = Auth::user()->character;
            $bullets = Cache::get('daily-bullets-quantity');
            $cost = Cache::get('daily-bullets-cost');

            if ($char->money < $request->amount * $cost) {
                return redirect()->back()->withErrors(['amount' => 'Insufficient funds.']);
            }

            if ($bullets - $request->amount < 0) {
                return redirect()->back()->withErrors(['amount' => 'There aren\'t that many bullets up for sale.']);
            }

            $char->money -= $request->amount * $cost;
            $char->bullets += $request->amount;
            $char->save();

            Cache::put('daily-bullets-quantity', $bullets - $request->amount, $this->oneDayInMinutes);

            return redirect()->back()->with(['status' => 'You just bought '.$request->amount.' bullets.']);
        }

        return redirect()->back()->withErrors(['general' => 'Hmm, you might have to try that again.']);
    }

    private function buyTransport(Request $request)
    {
        $this->validate($request, [
            'asset' => 'required|in:'.implode(',', array_keys($this->vehiclePrices)),
        ]);

        $char = Auth::user()->character;
        $currentVehicleValue = $this->vehiclePrices[$char->transport];
        $assetCost = $this->vehiclePrices[$request->asset];

        // Adding the currentVehicleValue first is equivalent to selling the current vehicle first
        // then buying the new asset. This is only saved when all conditions are met.
        $char->money += floor($currentVehicleValue * $this->sellRate);

        if ($char->transport === $request->asset) {
            return redirect()->back()->withErrors(['general' => 'You already own this type of vehicle.']);
        }

        if ($char->money < $assetCost) {
            return redirect()->back()->withErrors(['general' => 'Insufficient funds.']);
        }

        $char->money -= $assetCost;
        $char->transport = $request->asset;
        $char->save();

        return redirect()->back()->with(['status' => 'You just bought a '.$char->transport().'.']);
    }

    private function sellTransport(Request $request)
    {
        $this->validate($request, [
            'asset' => 'required|in:'.implode(',', array_keys($this->vehiclePrices)),
        ]);

        $char = Auth::user()->character;
        $assetCost = $this->vehiclePrices[$request->asset];

        if ($char->transport !== $request->asset) {
            return redirect()->back()->withErrors(['general' => 'You don\'t own this type of vehicle.']);
        }

        $char->money += floor($assetCost * $this->sellRate);
        $char->transport = 'none';
        $char->save();

        return redirect()->back()->with(['status' => 'You just sold your property.']);
    }

    private function buyWeapon(Request $request)
    {
        $this->validate($request, [
            'weapon' => 'required|in:'.implode(',', array_keys($this->weaponPrices)),
        ]);

        $char = Auth::user()->character;
        $currentWeaponValue = $this->weaponPrices[$char->weapon];
        $weaponCost = $this->weaponPrices[$request->weapon];

        // Adding the currentVehicleValue first is equivalent to selling the current vehicle first
        // then buying the new asset. This is only saved when all conditions are met.
        $char->money += floor($currentWeaponValue * $this->sellRate);

        if ($char->weapon === $request->weapon) {
            return redirect()->back()->withErrors(['general' => 'You already own this weapon.']);
        }

        if ($char->money < $weaponCost) {
            return redirect()->back()->withErrors(['general' => 'Insufficient funds.']);
        }

        $char->money -= $weaponCost;
        $char->weapon = $request->weapon;
        $char->save();

        return redirect()->back()->with(['status' => 'You just bought a '.$char->weapon().'.']);
    }

    private function sellWeapon(Request $request)
    {
        $this->validate($request, [
            'weapon' => 'required|in:'.implode(',', array_keys($this->weaponPrices)),
        ]);

        $char = Auth::user()->character;
        $weaponCost = $this->weaponPrices[$request->weapon];

        if ($char->weapon !== $request->weapon) {
            return redirect()->back()->withErrors(['general' => 'You don\'t own this weapon.']);
        }

        $char->money += floor($weaponCost * $this->sellRate);
        $char->weapon = 'none';
        $char->save();

        return redirect()->back()->with(['status' => 'You just sold your weapon.']);
    }
}
