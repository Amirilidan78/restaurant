<?php

namespace App\Http\Middleware;

use App\Services\Auth\AuthService;
use Closure;
use Illuminate\Http\Request;

class AuthJWTMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = AuthService::User() ;
        if ( !$user ) {
            throw new \Exception("unauthorized") ;
        }

        return $next($request);
    }
}
