<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contraband extends Model
{
    protected $table = 'contraband';

    // can carry a power of x for your rank of kgs (hitman == rank 3 == 3^2 == 9 kgs)
    private $carryPerRank = 2;

    public function canCarryAdditionalKgs(int $kgs)
    {
        return $this->weed + $this->lsd + $this->speed + $this->cocaine + $kgs <= $this->carryCapacity();
    }

    public function carryCapacity()
    {
        return pow($this->character->rankLevel(), $this->carryPerRank);
    }

    public function character()
    {
        return $this->belongsTo('App\Character');
    }
}
