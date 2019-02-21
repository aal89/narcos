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
    public function getCompose($character = '', $subject = '')
    {
        return view('menu.messages.compose')->with(['character' => $character])->with(['subject' => $subject]);
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
            'character' => 'required|min:3|max:255',
            'subject' => 'required|max:255',
            'message' => 'required|max:500',
        ]);

        try {
            $me = Auth::user()->character;
            $recipient = Character::findByName($request->character);
        } catch(\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['character' => 'Character '.$request->character.' does not exist, please double check the character name.']);
        }

        if ($me->name === $recipient->name) {
            return redirect()->back()->withInput()->withErrors(['character' => 'You cannot send yourself a message.']);
        }

        messageComposer($me->id, $recipient->id, $request->subject, $request->message);

        return redirect('/messages/outbox');
    }

    /**
     * Removes the messages if the logged in user happens to be the
     * owner of said message.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postDelete($id = 0)
    {
        try {
            Message::where('id', $id)->where('owner_id', Auth::user()->character->id)->firstOrFail()->delete();
            return redirect()->back();
        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['top' => 'Hmm, this message does not seem to belong to you.']);
        }
    }
}
