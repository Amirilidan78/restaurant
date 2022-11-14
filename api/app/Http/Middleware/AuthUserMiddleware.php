<?php

namespace App\Http\Middleware;

use App\Services\Auth\AuthService;
use App\Services\Auth\AuthTypeEnum;
use App\Services\Response\HttpStatusEnum;
use Closure;
use Illuminate\Http\Request;

class AuthUserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $model = AuthService::GetAuthenticatedEntity() ;

        if ( !$model )
            abort(HttpStatusEnum::UN_AUTHORIZED_RESPONSE_CODE,HttpStatusEnum::UN_AUTHORIZED_RESPONSE_TEXT) ;

        if ( $model->type != AuthTypeEnum::User )
            abort(HttpStatusEnum::UN_AUTHORIZED_RESPONSE_CODE,HttpStatusEnum::UN_AUTHORIZED_RESPONSE_TEXT) ;

        return $next($request);
    }
}
