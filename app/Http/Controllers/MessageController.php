<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;

class MessageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // We could add middleware specific for this controller like so:
        $this->middleware('mark.messages.read', ['only' => ['getInbox']]);
    }

    /**
     * Show the messages overview (inbox) also marks all messages as read.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getInbox()
    {
        return view('menu.messages.inbox');
    }

    /**
     * Show the messages outbox.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getOutbox()
    {
        return view('menu.messages.outbox');
    }

    /**
     * Show the message compose view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCompose()
    {
        return view('menu.messages.compose');
    }

    /**
     * Add new messages to the database one for the recipient (inbox) and one
     * for the sender (outbox).
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postCompose()
    {
        return view('menu.messages.outbox');
    }
}
