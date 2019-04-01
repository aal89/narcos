<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Message;

class InGameMessage extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $msg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Message $msg)
    {
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->msg->isSystemMessage()) {
            return $this->subject('You\'ve received an in-game message!')->markdown('mail.system.message');
        } else {
            return $this->subject('You\'ve received an in-game message!')->markdown('mail.message');
        }
    }
}
