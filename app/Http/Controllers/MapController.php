<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Character;
use App\Property;

class MapController extends Controller
{
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
}
