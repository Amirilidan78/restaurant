<?php

namespace App\Models\Enums;

enum UserGenderEnum : string
{
    case MALE = "male" ;
    case FEMALE = "female" ;

    public function text() : string
    {
        return match($this) {
            UserGenderEnum::MALE => "مرد",
            UserGenderEnum::FEMALE => "زن",
        };
    }
}
