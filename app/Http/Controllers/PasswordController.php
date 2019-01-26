<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Controller
    |--------------------------------------------------------------------------
    |
    | For some reason I couldn't extend the Auth\ResetPasswordController
    | somebody with more knowledge of this issue could probably resolve it in
    | the future. This now() function delivers a password reset request when
    | people are logged in. Does nothing otherwise.
    |
    */

    /**
     * Sends a password reset request to logged in users, does nothing if not
     * logged in.
     */
    public function now()
    {
        if (Auth::check()) {
            $response = Password::sendResetLink(['email' => Auth::user()->email], function (Illuminate\Mail\Message $message) {
                $message->subject('Your Password Reset Link');
            });

            switch ($response) {
                case Password::RESET_LINK_SENT:
                    return redirect()->back()->with('status', trans($response).' Log out now, then click the link in the e-mail!');
                case Password::INVALID_USER:
                    return redirect()->back()->withErrors(['email' => trans($response)]);
            }
        }
        return redirect('/');
    }
}
