<?php

namespace App\Observers;

use Illuminate\Support\Facades\Mail;
use App\Mail\InGameMessage;
use App\Message;

class MessageObserver
{
    public function saving(Message $msg) {
        // Code before save
    }

    public function saved(Message $msg) {
        // Only send mail to users who received the message (and have not read that message yet).
        if ($msg->owner !== $msg->sender && !$msg->read && $msg->recipient->user()->exists()) {
            Mail::to($msg->recipient->user->email)->queue(new InGameMessage($msg));
        }
    }
}
