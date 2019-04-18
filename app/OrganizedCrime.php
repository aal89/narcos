<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Character;

class OrganizedCrime extends Model
{
    /**
     * Returns true if the given Character can join any party.
     */
    public static function canJoin(Character $char)
    {
        return OrganizedCrime::where('robber_id', $char->id)
            ->orWhere('spotter_id', $char->id)
            ->orWhere('driver_id', $char->id)
            ->count() === 0;
    }

    /**
     * Finds the first occurrence where an organized crime party's robber, spotter or driver id
     * equals the given characters id. Returns null otherwise.
     */
    public static function getParty(Character $char)
    {
        return OrganizedCrime::where('robber_id', $char->id)
            ->orWhere('spotter_id', $char->id)
            ->orWhere('driver_id', $char->id)
            ->first() ?? null;
    }

    /**
     * Returns true if this party contains zero or one members.
     */
    public function isEmpty()
    {
        return !($this->robber()->exists() && $this->spotter()->exists()
            || $this->robber()->exists() && $this->driver()->exists()
            || $this->spotter()->exists() && $this->driver()->exists());
    }

    public function robber()
    {
        return $this->belongsTo('App\Character');
    }

    public function spotter()
    {
        return $this->belongsTo('App\Character');
    }

    public function driver()
    {
        return $this->belongsTo('App\Character');
    }
}
