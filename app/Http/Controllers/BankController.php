<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Character;

class BankController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // We could add middleware specific for this controller like so:
        // $this->middleware('auth');
    }

    /**
     * Show the banking view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex()
    {
        return view('menu.banking.banking');
    }

    /**
     * Deposits or withdraw money from the bank.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postIndex(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|integer',
        ]);

        $char = Auth::user()->character;

        switch($request->action)
        {
            case 'deposit':
                try {
                    $this->deposit(abs(intval($request->amount)), $char);
                    return redirect()->back();
                } catch(\Exception $e) {
                    return redirect()->back()->withErrors(['amount' => $e->getMessage()]);
                }
            case 'withdraw':
                try {
                    $this->withdraw(abs(intval($request->amount)), $char);
                    return redirect()->back();
                } catch(\Exception $e) {
                    return redirect()->back()->withErrors(['amount' => $e->getMessage()]);
                }
            default: return redirect()->back()->withErrors(['amount' => 'Hmm, you might have to try that again.']);
        }
    }

    /**
     * Deposits a given amount to the given characters bank account.
     * Throws errors if attempt to deposit failed, for example when the user
     * does not have sufficient funds.
     */
    private function deposit(int $amount, \App\Character $char)
    {
        if ($char->money >= $amount) {
            $char->money -= $amount;
            $char->bank->money += $amount;
            $char->save();
            $char->bank->save();
            return;
        }
        throw new \Exception('Insufficient funds on hand.');
    }

    /**
     * Withdraws a given amount from the given characters bank account.
     * Throws errors if attempt to deposit failed, for example when the user
     * does not have sufficient funds.
     */
    private function withdraw(int $amount, \App\Character $char)
    {
        if ($char->bank->money >= $amount) {
            $char->money += $amount;
            $char->bank->money -= $amount;
            $char->save();
            $char->bank->save();
            return;
        }
        throw new \Exception('Insufficient funds on bank account.');
    }
}
