<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Bank extends Model
{
    private $DAY_IN_HOURS = 24;

    public function character()
    {
        return $this->belongsTo('App\Character');
    }

    /**
     * The number of hours since this bank account had a last withdrawal or deposit action
     * in the last 24 hrs.
     * Note; this property is derived from the rows updated_at field. Any system alteration
     * (like interest pay out) can also reset this calculation.
     */
    public function hoursSinceLastAction()
    {
        return $this->DAY_IN_HOURS - min($this->DAY_IN_HOURS, $this->updated_at->diffInHours(Carbon::now()));
    }

    public function moneyWithInterest()
    {
        return inflateAmount($this->money);
    }
}
