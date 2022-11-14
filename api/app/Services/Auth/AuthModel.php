<?php

namespace App\Services\Auth;

class AuthModel
{

    public function __construct(
        public AuthTypeEnum $type ,
        public string $first_name ,
        public string $last_name ,
        public string $username ,
        public string $email ,
        public string $phone ,
    )
    {}

    public function toArray() : array
    {
        return [
            "type" => $this->type->value ,
            "first_name" => $this->first_name ,
            "last_name" => $this->last_name ,
            "username" => $this->username ,
            "email" => $this->email ,
            "phone" => $this->phone ,
        ] ;
    }

}
