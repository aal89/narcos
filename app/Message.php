<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Character;
use App\Observers\MessageObserver;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject', 'message',
    ];

    public static function boot() {
        parent::boot();
        self::observe(new MessageObserver);
    }

    /**
     * Returns the number of unread messages for a given character.
     */
    public static function countUnread(Character $char)
    {
        return Message::where('owner_id', $char->id)->where('read', 0)->count();
    }

    /**
     * Mark all messages as read for a given character. Does not update messages
     * which are already read.
     */
    public static function markAllAsRead(Character $char)
    {
        return Message::where('owner_id', $char->id)->where('read', 0)->update(['read' => true]);
    }

    /**
     * Returns the character which owns this message.
     */
    public function owner()
    {
        return $this->belongsTo('App\Character');
    }

    /**
     * Returns the character which sent this message.
     */
    public function sender()
    {
        return $this->belongsTo('App\Character');
    }

    /**
     * Returns the character which is the recipient of this message.
     */
    public function recipient()
    {
        return $this->belongsTo('App\Character');
    }
}
