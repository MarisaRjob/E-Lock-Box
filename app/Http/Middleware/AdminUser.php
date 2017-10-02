<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class AdminUser
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
//        $user = Sentinel::getUser();
        if($user = Sentinel::check()) {
            $admin = Sentinel::findRoleByName('Admins');

            if (!$user->inRole($admin)) {
                return redirect('fail');
            }
            return $next($request);
        } else {
            return redirect()->intended('/login')->withErrorMessage('You need to login!');
        }

    }
}
