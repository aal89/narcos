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

    /**
     * Handler to edit a tile belonging to the logged in character. Either changes a setup,
     * collects a yield or releases a particular tile from the map.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postEditTile(Request $request, int $tile)
    {
        $char = Auth::user()->character;
        $property = $char->properties->where('country', $char->country)->where('tile', $tile)->first();

        if ($property === null) {
            return redirect()->back()->withErrors(['general' => 'This is not your property.']);
        }

        switch($request->action) {
            case 'collect': return $this->handleCollect($char, $property);
            case 'convert': return $this->handleConvert($char, $property, $request->setup);
            case 'release': return $this->handleRelease($char, $property);
            default: return redirect()->back()->withErrors(['general' => 'Unknown action.']);
        }
    }

    /**
     * Collects a yield from the property.
     */
    private function handleCollect(Character $char, Property $property)
    {
        if (!$property->hasSetup()) {
            return redirect()->back()->withErrors(['general' => 'This property has nothing on it yet. Choose a setup first.']);
        }

        if (!$char->contraband->canCarryAdditionalKgs($property->yield())) {
            return redirect()->back()->withErrors(['general' => 'You can\'t carry that much.']);
        }

        $yieldAsInteger = $property->yield();
        $property->yield -= $yieldAsInteger;
        $char->contraband->{$property->setup} += $yieldAsInteger;

        $property->save();
        $char->contraband->save();

        return redirect()->back()->with('status', 'You collected '.$yieldAsInteger.'kg(s) '.$property->setup.' from square #'.$property->tile.'.');
    }

    /**
     * Collects a yield from the property.
     */
    private function handleConvert(Character $char, Property $property, string $setup)
    {
        $property->setup = $setup;
        $property->setup_updated_at = now();

        if ($property->hasYield()) {
            return redirect()->back()->withErrors(['general' => 'You should first clean out before changing setups. Collect all narcotics.']);
        }

        // Discards left overs of the yield and start counting from 0 again
        $property->yield = 0.0;

        try {
            $property->save();
            return redirect()->back()->with('status', 'You changed setups for square #'.$property->tile.'.');
        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['general' => 'Unknown setup.']);
        }
    }

    /**
     * Collects a yield from the property.
     */
    private function handleRelease(Character $char, Property $property)
    {
        $property->delete();
        return redirect()->back()->with('status', 'You released square #'.$property->tile.'.');
    }
}
