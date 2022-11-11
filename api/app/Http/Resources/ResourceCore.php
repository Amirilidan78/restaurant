<?php

namespace App\Http\Resources;

use App\Services\Response\HttpStatusEnum;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class ResourceCore extends JsonResource
{
    use ResourceTrait ;

    public function withResponse($request, $response)
    {
        $response->setStatusCode(HttpStatusEnum::RESOURCE_RESPONSE_CODE, HttpStatusEnum::RESOURCE_RESPONSE_TEXT);
    }
}
