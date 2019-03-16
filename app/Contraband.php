<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contraband extends Model
{
    protected $table = 'contraband';

    public function character()
    {
        return $this->belongsTo('App\Character');
    }
}
