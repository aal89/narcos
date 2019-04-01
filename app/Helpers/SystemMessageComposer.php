<?php

use App\Message;
use App\Character;

if (!function_exists('systemMessageComposer')) {

    /**
     * Creates an system message, sets the from and to side to the same character. This message
     * is verified automatically.
     *
     * @param Character $char To send the system message.
     * @param string $subject
     * @param string $msg
     */
    function systemMessageComposer(Character $char, $subject, $msg)
    {
        $inbox = new Message();
        $inbox->owner_id = $char->id;
        $inbox->sender_id = $char->id;
        $inbox->recipient_id = $char->id;
        $inbox->subject = $subject;
        $inbox->message = $msg;
        $inbox->trusted = true;
        $inbox->save();
    }
}
