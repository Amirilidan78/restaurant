<?php

namespace App\Http\Middleware;

use App\Services\Auth\AuthService;
use App\Services\Auth\AuthTypeEnum;
use Closure;
use Illuminate\Http\Request;

class AuthUserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $model = AuthService::GetAuthenticatedEntity() ;

        if ( !$model )
            throw new \Exception("unauthorized") ;

        if ( $model->type != AuthTypeEnum::User )
            throw new \Exception("unauthorized") ;


        return $next($request);
    }
}
