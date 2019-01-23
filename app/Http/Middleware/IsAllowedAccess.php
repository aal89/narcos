<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAllowedAccess
{
    /**
     * Checks if the an user is logged and if this user is not banned. If no logged in
     * user is found it always goes $next.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() && !Auth::user()->isBanned())
        {
            return $next($request);
        }
        return redirect('/banned');
    }
}
