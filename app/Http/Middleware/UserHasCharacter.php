<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserHasCharacter
{
    /**
     * Checks whether the user associated with the request has a Character and if this Character is alive.
     * Life column mustn't be 0.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user())
        {
            var_dump(Auth::user()->hasCharacter());
        }
        return $next($request);
    }
}
