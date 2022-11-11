<?php

namespace App\Http\Resources\Secure;

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
            "gender" => $this["gender"] ,
            "birth_date" => $this["birth_date"] ,
            "avatar" => $this["avatar"] ,
            "address" => $this["address"] ,
            "mobile" => $this["mobile"] ,
            "state" => $this["state"] ,
        ];
    }
}
