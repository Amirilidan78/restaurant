<?php

namespace App\Http\Middleware;

use App\Services\Auth\AuthService;
use App\Services\Auth\AuthTypeEnum;
use Closure;
use Illuminate\Http\Request;

class AuthAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $model = AuthService::GetAuthenticatedEntity() ;

        if ( !$model )
            throw new \Exception("unauthorized") ;

        if ( $model->type != AuthTypeEnum::Admin )
            throw new \Exception("unauthorized") ;


        return $next($request);
    }
}
