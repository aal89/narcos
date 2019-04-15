<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Character;
use App\Property;

class MapController extends Controller
{
    private $pricePerSquare = 50000;
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
     * Show the map.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex()
    {
        return view('menu.map.index')
            ->with('chosenTile', 'none')
            ->with('tiles', Property::byCountry(Auth::user()->character->country));
    }

    /**
     * Get a tile for a given country and return status.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getTile(int $tile)
    {
        $tiles = Property::byCountry(Auth::user()->character->country);
        $chosenTile = $tiles->filter(function($item) use($tile) {
            return $item->tile === $tile;
        })->first();
        return view('menu.map.index')
            ->with('chosenTile', $chosenTile)
            ->with('tiles', $tiles);
    }

    /**
     * Tries to buy a piece of land.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postTile(int $tile)
    {
        $char = Auth::user()->character;

        if ($char->money < $this->pricePerSquare) {
            return redirect()->back()->withErrors(['general' => 'Insufficient funds.']);
        }

        if (!isTileForSale($char->country, $tile)) {
            return redirect()->back()->withErrors(['general' => 'This square is not for sale.']);
        }

        $prop = new Property();
        $prop->character_id = $char->id;
        $prop->country = $char->country;
        $prop->tile = $tile;

        try {
            $prop->save();
            $char->money -= $this->pricePerSquare;
            $char->save();
            return redirect()->back()->with('status', 'You just bought square #'.$tile.'.');
        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['general' => 'Square #'.$tile.' has already been sold to someone else.']);
        }
    }
}
