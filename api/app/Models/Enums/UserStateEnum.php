<?php

namespace App\Models\Enums;

enum UserStateEnum : string
{
    case PENDING = "pending" ;
    case ACTIVE = "active" ;
    case SUSPEND = "suspend" ;

    public function text() : string
    {
        return match($this) {
            UserStateEnum::PENDING => "انتظار",
            UserStateEnum::ACTIVE => "فعال",
            UserStateEnum::SUSPEND => "غیر فعال",
        };
    }

}
