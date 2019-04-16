<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public function inProduction()
    {
        return $this->setup !== null && $this->updated_at->diffInHours(Carbon::now()) >= 12;
    }

    public function yield()
    {
        return floor($this->yield);
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
