<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use App\Tools\Cooldown;

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
        return Character::where('name', $name)->firstOrFail();
    }

    /**
     * Selects a random character out of the last 50 active ones in a particular country.
     * Rules out any character given in the $except parameter. Returns null if no
     * character could be selected.
     * 
     * @param string $country
     * @param Character ...$except
     */
    public static function randomActiveInCountry($country, Character ...$except)
    {
        $characters = Character::where('country', $country);

        foreach($except as $character) {
            $characters->where('id', '!=', $character->id);
        }

        $fetchedChars = $characters
            ->orderBy('updated_at', 'desc')
            ->limit(50)
            ->get()
            ->shuffle();

        return count($fetchedChars) > 0 ? $fetchedChars[0] : null;
    }

    /**
     * Calculates the rank belonging to this character based on it's experience.
     * It is a derived value.
     */
    public function rank()
    {
        return integerToRank($this->experience)[1];
    }

    /**
     * Return the rank of this character represented as an integer. For example
     * Low-life is rank level 1.
     */
    public function rankLevel()
    {
        return integerToRank($this->experience)[0];
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
     * Returns an indication of the wealth this player has accumulated 
     */
    public function wealth()
    {
        return moneyToWealth($this->money);
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
     * This Characters transport formatted in a human preferable way. E.g. Plane,
     * instead of plane.
     */
    public function transport()
    {
        return ucfirst($this->transport);
    }

    /**
     * This Characters life status simplified into two terms (alive or dead).
     * If live is above 0 returns alive, dead otherwise.
     */
    public function life()
    {
        return $this->life > 0 ? 'Alive' : 'Dead';
    }

    /**
     * This Characters weapon formatted in a human preferable way. E.g. Plane,
     * instead of plane.
     */
    public function weapon()
    {
        return ucfirst($this->weapon);
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

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
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

    /**
     * Gets all your messages, inbox and outbox mixed together.
     */
    public function messages()
    {
        return $this->hasMany('App\Message', 'owner_id');
    }

    public function messagesOutbox()
    {
        return $this->hasMany('App\Message', 'sender_id')->where('owner_id', $this->id)->orderBy('created_at', 'desc');;
    }

    public function messagesInbox()
    {
        return $this->hasMany('App\Message', 'recipient_id')->where('owner_id', $this->id)->orderBy('created_at', 'desc');;
    }

    public function hide()
    {
        $this->hidden_until = Carbon::now()->addDay();
    }

    public function isHidden()
    {
        return $this->hidden_until ? Carbon::parse($this->hidden_until)->isFuture() : false;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function bank()
    {
        return $this->hasOne('App\Bank');
    }

    public function counter()
    {
        return $this->hasOne('App\Counter');
    }

    public function contraband()
    {
        return $this->hasOne('App\Contraband');
    }

    public function properties()
    {
        return $this->hasMany('App\Property');
    }

    public function can()
    {
        return new Cooldown($this);
    }
}
