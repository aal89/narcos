<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Checks if this character could be released.
     */
    public function isReleasable()
    {
        return $this->user_id !== null && $this->life === 0;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
