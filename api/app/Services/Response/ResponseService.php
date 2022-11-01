<?php

namespace App\Services\Response;

use App\Services\Response\HttpStatusEnum;
use Illuminate\Http\Response;

class ResponseService
{
    public function ok( array $payload = [] ) : Response
    {
        return ( new Response($payload) )->setStatusCode( HttpStatusEnum::OK_RESPONSE_CODE ,HttpStatusEnum::OK_RESPONSE_TEXT ) ;
    }

    public function entity_not_found( string $entity_name ,string|int $id ) : Response
    {
        return ( new Response([ 'message' => ucfirst($entity_name) . " #$id not found!" ]) )->setStatusCode( HttpStatusEnum::ENTITY_NOT_FOUND_RESPONSE_CODE ,HttpStatusEnum::ENTITY_NOT_FOUND_RESPONSE_TEXT ) ;
    }

    public function invalid_params( string $message ) : Response
    {
        return ( new Response([ 'message' => $message ]) )->setStatusCode( HttpStatusEnum::INVALID_PARAMS_RESPONSE_CODE ,HttpStatusEnum::INVALID_PARAMS_RESPONSE_TEXT ) ;
    }

    public function forbidden() : Response
    {
        return ( new Response() )->setStatusCode( HttpStatusEnum::FORBIDDEN_RESPONSE_CODE ,HttpStatusEnum::FORBIDDEN_RESPONSE_TEXT ) ;
    }

    public function error( string $message = "Operation failed!" ) : Response
    {
        return ( new Response([ 'message' => $message ]) )->setStatusCode( HttpStatusEnum::REPORTABLE_ERROR_RESPONSE_CODE ,HttpStatusEnum::REPORTABLE_ERROR_RESPONSE_TEXT ) ;
    }

    public function server_error() : Response
    {
        return ( new Response() )->setStatusCode( HttpStatusEnum::UN_REPORTABLE_ERROR_RESPONSE_CODE ,HttpStatusEnum::UN_REPORTABLE_ERROR_RESPONSE_TEXT ) ;
    }

}
