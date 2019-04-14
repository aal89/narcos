<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{

    public static function byCountry(string $country)
    {
        return Property::where('country', $country)->get();
    }

    public function character()
    {
        return $this->belongsTo('App\Character');
    }
}
