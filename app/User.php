<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Indicates whether this user is banned or not.
     */
    public function isBanned()
    {
        return $this->banned;
    }

    /**
     * Checks if this model's Character exists and is alive.
     */
    public function hasCharacter()
    {
        return $this->character()->exists() && $this->character->isAlive();
    }

    public function character()
    {
        return $this->hasOne('App\Character');
    }

}
