<?php

namespace App\Models\Enums;

enum UserStateEnum : string
{
    case PENDING = "pending" ;
    case ACTIVE = "active" ;
    case SUSPEND = "suspend" ;
}
