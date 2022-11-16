<?php

namespace App\Http\Resources\NotSecure;

use App\Http\Resources\ResourceCore;

class UserResource extends ResourceCore
{
    public function toArray($request)
    {
        return [
            "id" => $this["id"] ,
            "first_name" => $this["first_name"] ,
            "last_name" => $this["last_name"] ,
            "email" => $this["email"] ,
            "phone" => $this["phone"] ,
            "mobile" => $this["mobile"] ,
            "gender" => $this["gender"] ,
            "gender_text" => $this["gender"]?->text() ,
            "address" => $this["address"] ,
            "avatar" => $this["avatar"] ,
            "state" => $this["state"] ,
            "state_text" => $this["state"]?->text() ,
        ];
    }
}
