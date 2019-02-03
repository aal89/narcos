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
        $this->middleware('mark.messages.read', ['except' => ['getOutbox', 'getCompose']]);
    }

    /**
     * Show the messages overview also marks all messages as read.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getInbox()
    {
        return view('menu.messages.inbox');
    }

    /**
     * Show the messages overview also marks all messages as read.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getOutbox()
    {
        return view('menu.messages.outbox');
    }
}
