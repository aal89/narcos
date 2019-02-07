<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * Deposits money in the bank.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postIndex()
    {
        return view('menu.banking.banking');
    }
}
