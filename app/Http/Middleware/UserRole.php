<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class UserRole
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
        if (Auth::check()) {

            if (auth()->user()->role == 'super_admin') {
                return $next($request);
            }elseif (auth()->user()->role == 'admin') {
                return $next($request);
            }elseif (auth()->user()->role == 'vendor') {
                return $next($request);
            }else{
                return redirect()->route('home');

            }
            
        }else{
            return redirect()->route('home');
        }
        
    }
}
