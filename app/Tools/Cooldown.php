<?php
// app/Tools/SomeExampleClass.php
namespace App\Tools;

use App\Character;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

/**
 * Cooldown class to create and readback entries in a Cache.
 */
class Cooldown
{
    private $character;
    /**
     * Create a new cooldown instance.
     *
     * @return void
     */
    public function __construct(Character $character)
    {
        $this->character = $character;
    }

    /**
     * Determines if you can travel. Returns true if you can, false otherwise.
     */
    public function travel()
    {
        return !Cache::has('travel-cooldown-'.$this->character->name);
    }

    /**
     * Calculates and return an integer indicating when the cooldown passes.
     */
    public function travelInMinutes()
    {
        if (Cache::has('travel-cooldown-'.$this->character->name)) {
            return Carbon::parse(Cache::get('travel-cooldown-'.$this->character->name))->diffInMinutes(Carbon::now());
        }
        return 0;
    }

    /**
     * Resets the travel cooldown in the Cache.
     */
    public function resetTravel()
    {
        $cooldown = cooldownForAsset($this->character->transport);
        Cache::put('travel-cooldown-'.$this->character->name, Carbon::now()->addMinutes($cooldown), $cooldown);
    }
}