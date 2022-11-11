<?php

namespace App\Http\Resources;


use App\Services\Response\HttpStatusEnum;
use Illuminate\Http\Resources\Json\ResourceCollection;

abstract class CollectionCore extends ResourceCollection
{
    public function withResponse($request, $response)
    {
        $response->setStatusCode(HttpStatusEnum::COLLECTION_RESPONSE_CODE, HttpStatusEnum::COLLECTION_RESPONSE_TEXT);
    }
}
