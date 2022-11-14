<?php

namespace App\Services\Auth;

enum AuthTypeEnum : string
{
    case User = "user" ;
    case Admin = "admin" ;
}
