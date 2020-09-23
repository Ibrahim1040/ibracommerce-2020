<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Gérez une demande entrante.
     * Cette fonction permet de vérifier si c'est un user ou un admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        switch ($guard){
            case 'admin':
                if (Auth::guard($guard)->check()) {
                    return redirect('/admin-dashboard');
                }
                break;
            case 'auth':
                if (Auth::guard($guard)->check()) {
                    return redirect('/');
                }
                break;
        }

        return $next($request);
    }
}
