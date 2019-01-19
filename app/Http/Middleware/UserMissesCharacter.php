<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserMissesCharacter
{
    /**
     * Checks if the user associated with the request does not have a character already. No character means a new player,
     * a dead character is an existing player. If the user in question does have a character and is alive then we
     * redirect them to home.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() && !Auth::user()->hasCharacter())
        {
            return $next($request);
        }
        return redirect('home');
    }
}
