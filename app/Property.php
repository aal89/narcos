<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public function inProduction()
    {
        return $this->setup !== null && Carbon::parse($this->setup_updated_at)->diffInHours(Carbon::now()) >= 12;
    }

    public function yield()
    {
        return floor($this->yield);
    }

    /**
     * Determines if the property still has narcotics stored. This is counted from 1
     * whole kilo and up. Everything below 1.0kgs (e.g. 0.87) is not counted.
     */
    public function hasYield()
    {
        return $this->yield >= 1.0;
    }

    public static function byCountry(string $country)
    {
        return Property::where('country', $country)->get();
    }

    public function character()
    {
        return $this->belongsTo('App\Character');
    }
}
