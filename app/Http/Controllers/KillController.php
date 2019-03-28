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
    public function postKill(Request $request)
    {
        $this->validate($request, [
            'character' => 'required|min:3|max:25|alpha_dash',
            'bullets' => 'required|integer|min:1'
        ]);

        // todo actual killing logic

        return redirect()->back();
    }
}
