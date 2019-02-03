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

    public static function findByName($name)
    {
        return Character::where('name', $name)->first();
    }

    /**
     * Calculates the rank belonging to this character based on it's experience.
     * It is a derived value.
     */
    public function rank()
    {
        return integerToRank($this->experience);
    }

    /**
     * This Characters money formatted in a human preferable way. E.g. 132.844,
     * instead of 132844.
     */
    public function money()
    {
        return number_format($this->money, 0, '.', '.');
    }

    /**
     * This Characters country formatted in a human preferable way. E.g. United
     * States of America, instead of united states of america.
     */
    public function country()
    {
        return str_replace('Of', 'of', ucwords($this->country));
    }

    /**
     * This Characters contraband formatted in a human preferable way. E.g. 1.200,
     * instead of 1200.
     */
    public function contraband()
    {
        return number_format($this->contraband, 0, '.', '.');
    }

    /**
     * This Characters transport formatted in a human preferable way. E.g. Plane,
     * instead of plane.
     */
    public function transport()
    {
        return ucfirst($this->transport);
    }

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

    public function messages()
    {
        return $this->hasMany('App\Message', 'owner_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }
}
