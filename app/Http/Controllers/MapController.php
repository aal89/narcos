<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('menu.map.index');
    }

    /**
     * Get a tile for a given country and return status.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getTile(string $country, int $tile)
    {
        return view('menu.map.index')->with([
            'country' => $country,
            'tile' => $tile
        ]);
    }
}
