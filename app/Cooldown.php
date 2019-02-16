<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Cooldown extends Model
{
    public function character()
    {
        return $this->belongsTo('App\Character');
    }

    public function travel()
    {
        return Carbon::parse($this->travel)->isPast();
    }

    public function travelInMinutes()
    {
        return Carbon::parse($this->travel)->diffInMinutes(Carbon::now());
    }
}
