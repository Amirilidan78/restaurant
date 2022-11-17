<?php

namespace App\Http\Resources\NotSecure;

use App\Http\Resources\ResourceCore;

class AdminResource extends ResourceCore
{
    public function toArray($request)
    {
        return [
            'id' => $this['id'] ,
            "username" => $this["username"] ,
            "first_name" => $this["first_name"] ,
            "last_name" => $this["last_name"] ,
            "phone" => $this["phone"] ,
            "email" => $this["email"] ,
            "avatar" => $this["avatar"] ,
            "state" => $this["state"] ,
            "role" => $this["role"]?->value ,
            "role_text" => $this["role"]?->text() ,
        ];

    }
}
