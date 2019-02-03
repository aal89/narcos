<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Message;

class MarkMessagesRead
{
    /**
     * For each request coming checks if an user is logged in, if so mark all it's
     * messages as read. Always resolves and next'ed the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check())
        {
            Message::markAllAsRead(Auth::user()->character);
        }
        return $next($request);
    }
}
