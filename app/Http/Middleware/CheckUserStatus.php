<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {

            $user = auth()->user();

            if (!$user->hasVerifiedEmail()) {
                Auth::logout();
                return redirect('/login')
                    ->withErrors(['email' => 'Please verify your email.']);
            }

            if ($user->status !== 'active') {
                Auth::logout();
                return redirect('/login')
                    ->withErrors(['email' => 'Your account is not active.']);
            }
        }

        return $next($request);
    }
}
