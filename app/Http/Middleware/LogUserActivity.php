<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LogUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()) {
            // save last used ip if it differs
            $user = Auth::user();

            if($user->last_used_ip !== $request->ip()) {
                $user->last_used_ip = $request->ip();
                $user->save();
            }

            $expiresAt = Carbon::now()->addMinutes(5);
            // todo: when application grows, use different cache provider (fs is not ideal)
            Cache::put('user-is-online-' . Auth::user()->character->id, true, $expiresAt);
        }
        return $next($request);
    }
}
