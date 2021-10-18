<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Role
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
        if (!Auth::check()){
            return redirect('login'); 
        }
        
        $user = Auth::user();

        if(! $user->isAdmin()){
            Auth::logout();
            return redirect('/login'); 

        }

        return $next($request);
    }
}
