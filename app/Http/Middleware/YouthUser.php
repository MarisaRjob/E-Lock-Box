<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class YouthUser
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
        if($user = Sentinel::check()) {
            $youth = Sentinel::findRoleByName('Youths');

            if (!$user->inRole($youth)) {
                return redirect('fail');
            }
            return $next($request);
        } else {
            return redirect()->intended('/login')->withErrorMessage('You need to login!');
        }
    }
}
