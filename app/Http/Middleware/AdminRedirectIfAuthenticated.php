<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class AdminRedirectIfAuthenticated
{
    
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
            if (Auth::guard('admin')->check()) {
                return redirect()->route('admin.dashboard');  
    }

        return $next($request);
    }
}