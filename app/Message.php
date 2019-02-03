<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Character;

class Message extends Model
{
    public static function countUnread(Character $char)
    {
        return Message::where('owner_id', $char->id)->where('read', 0)->count();
    }

    public static function markAllAsRead(Character $char)
    {
        return Message::where('owner_id', $char->id)->where('read', 0)->update(['read' => true]);
    }

    public function owner()
    {
        return $this->belongsTo('App\Character');
    }

    public function sender()
    {
        return $this->belongsTo('App\Character');
    }

    public function recipient()
    {
        return $this->belongsTo('App\Character');
    }
}
