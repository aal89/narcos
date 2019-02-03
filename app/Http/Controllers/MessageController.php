<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;

class MessageController extends Controller
{
    /**
     * Show the messages overview also marks all messages as read.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Message::markAllAsRead(Auth::user()->character);
        return view('menu.messages.index');
    }
}
