<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class StaffUser
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
            $staff = Sentinel::findRoleByName('Staff');

            if (!$user->inRole($staff)) {
                return redirect('fail');
            }
            return $next($request);
        } else {
            return redirect()->intended('/login')->withErrorMessage('You need to login!');
        }
    }
}
