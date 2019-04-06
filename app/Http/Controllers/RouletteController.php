<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouletteController extends Controller
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
     * Show the roulette game view.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex()
    {
        return view('menu.roulette.index');
    }

    /**
     * Try your luck and gameble for money in a roulette game.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postIndex(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'n1st12' => 'nullable|integer|min:1',
            'n1to18' => 'nullable|integer|min:1',
            'neven' => 'nullable|integer|min:1',
            'n2nd12' => 'nullable|integer|min:1',
            'nred' => 'nullable|integer|min:1',
            'nblack' => 'nullable|integer|min:1',
            'n3rd12' => 'nullable|integer|min:1',
            'nodd' => 'nullable|integer|min:1',
            'n19to36' => 'nullable|integer|min:1',
            'n0' => 'nullable|integer|min:1',
            'n1' => 'nullable|integer|min:1',
            'n2' => 'nullable|integer|min:1',
            'n3' => 'nullable|integer|min:1',
            'n4' => 'nullable|integer|min:1',
            'n5' => 'nullable|integer|min:1',
            'n6' => 'nullable|integer|min:1',
            'n7' => 'nullable|integer|min:1',
            'n8' => 'nullable|integer|min:1',
            'n9' => 'nullable|integer|min:1',
            'n10' => 'nullable|integer|min:1',
            'n11' => 'nullable|integer|min:1',
            'n12' => 'nullable|integer|min:1',
            'n13' => 'nullable|integer|min:1',
            'n14' => 'nullable|integer|min:1',
            'n15' => 'nullable|integer|min:1',
            'n16' => 'nullable|integer|min:1',
            'n17' => 'nullable|integer|min:1',
            'n18' => 'nullable|integer|min:1',
            'n19' => 'nullable|integer|min:1',
            'n20' => 'nullable|integer|min:1',
            'n21' => 'nullable|integer|min:1',
            'n22' => 'nullable|integer|min:1',
            'n23' => 'nullable|integer|min:1',
            'n24' => 'nullable|integer|min:1',
            'n25' => 'nullable|integer|min:1',
            'n26' => 'nullable|integer|min:1',
            'n27' => 'nullable|integer|min:1',
            'n28' => 'nullable|integer|min:1',
            'n29' => 'nullable|integer|min:1',
            'n30' => 'nullable|integer|min:1',
            'n31' => 'nullable|integer|min:1',
            'n32' => 'nullable|integer|min:1',
            'n33' => 'nullable|integer|min:1',
            'n34' => 'nullable|integer|min:1',
            'n35' => 'nullable|integer|min:1',
            'n36' => 'nullable|integer|min:1',
            'n2to11' => 'nullable|integer|min:1',
            'n2to12' => 'nullable|integer|min:1',
            'n2to13' => 'nullable|integer|min:1'
        ]);

        if ($validator->fails()) {
            $validator->errors()->add('general', 'One or more inputs have wrong values, only positive integers allowed!');
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $char = Auth::user()->character;

        return redirect()->back();
    }
}
