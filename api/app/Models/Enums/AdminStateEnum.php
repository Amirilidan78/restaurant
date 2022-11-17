<?php

namespace App\Models\Enums;

enum AdminStateEnum : string
{
    case ACTIVE = "active" ;
    case DISABLED = "disabled" ;

    public function text() : string
    {
        return match($this) {
            AdminStateEnum::ACTIVE => "فعال",
            AdminStateEnum::DISABLED => "غیر فعال",
        };
    }
}
