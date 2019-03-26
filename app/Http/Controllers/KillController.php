<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KillController extends Controller
{
    /**
     * Returns character kill view.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getKill()
    {
        return view('menu.kill.index');
    }

    /**
     * Attempt to kill another character.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postKill()
    {
        return redirect('/kill');
    }
}
