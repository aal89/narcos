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
     * Indication if this character has died.
     */
    public function isDead()
    {
        return $this->life === 0;
    }

    /**
     * Indication if this character is alive.
     */
    public function isAlive()
    {
        return $this->life > 0;
    }

    /**
     * Releases this character if it can, does nothing otherwise. When you release a character it'll become a
     * 'dangling' one. The user_id column gets nulled.
     */
    public function release()
    {
        if ($this->isReleasable())
        {
            $this->user_id = null;
            $this->save();
        }
    }

    /**
     * Checks if this character could be released.
     */
    public function isReleasable()
    {
        return $this->user_id !== null && $this->isDead();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
