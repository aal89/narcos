<?php

use App\Message;

if (!function_exists('messageComposer')) {

    /**
     * Creates an inbox and outbox messages at once. The outbox message
     * is read automatically.
     *
     * @param string $from Character id.
     * @param string $to Character id.
     * @param string $subject
     * @param string $msg
     */
    function messageComposer($from, $to, $subject, $msg)
    {
        $inbox = new Message();
        $inbox->owner_id = $to;
        $inbox->sender_id = $from;
        $inbox->recipient_id = $to;
        $inbox->subject = $subject;
        $inbox->message = $msg;
        $inbox->save();
        $outbox = new Message();
        $outbox->owner_id = $from;
        $outbox->sender_id = $from;
        $outbox->recipient_id = $to;
        $outbox->subject = $subject;
        $outbox->message = $msg;
        $outbox->read = true;
        $outbox->save();
    }
}
