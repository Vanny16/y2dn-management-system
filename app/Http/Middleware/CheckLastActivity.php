<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckLastActivity
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            $lastActivity = Session::get('last_activity', time());

            if (time() - $lastActivity > 300) { // 300 seconds (5 minutes)
                Auth::logout();
                return redirect('/login')->with('error', 'Your session has expired due to inactivity.');
            }

            Session::put('last_activity', time());
        }

        return $next($request);
    }
}
