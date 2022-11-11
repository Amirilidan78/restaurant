<?php

namespace App\Http\Resources\NotSecure;

use App\Http\Resources\ResourceCore;

class UserResource extends ResourceCore
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
