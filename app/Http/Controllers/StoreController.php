<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreController extends Controller
{
    private $prices = [
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
        $this->validate($request, [
            'asset' => 'required|in:'.implode(',', array_keys($this->prices)),
        ]);

        $char = Auth::user()->character;
        $assetCost = $this->prices[$request->asset];

        if ($char->transport === $request->transport) {
            return redirct()->back()->withErrors(['asset' => 'You already own this type of vehicle.']);
        }

        if ($char->money < $assetCost) {
            return redirect()->back()->withErrors(['asset' => 'Insufficient funds.']);
        }

        $char->money -= $assetCost;
        $char->transport = $request->asset;
        $char->save();

        return redirect()->back();
    }
}
