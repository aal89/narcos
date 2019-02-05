<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\Character;

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
    public function postCompose(Request $request)
    {
        $this->validate($request, [
            'character' => 'required|max:255',
            'subject' => 'required|max:255',
            'message' => 'required|max:500',
        ]);

        try {
            $me = Auth::user()->character;
            $recipient = Character::findByName($request->character);
        } catch(\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['unknown_recipient' => 'Character '.$request->character.' does not exist, please double check the character name.']);
        }

        if ($me->name === $recipient->name) {
            return redirect()->back()->withInput()->withErrors(['self_recipient' => 'You cannot send yourself a message.']);
        }

        $msg = new Message($request->all());
        $msg->owner_id = $me->id;
        $msg->sender_id = $me->id;
        $msg->recipient_id = $recipient->id;
        $msg->read = true;
        $msg->save();

        $msg = new Message($request->all());
        $msg->owner_id = $recipient->id;
        $msg->sender_id = $me->id;
        $msg->recipient_id = $recipient->id;
        $msg->save();

        return view('menu.messages.outbox');
    }
}
