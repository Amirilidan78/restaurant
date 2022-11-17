<?php

namespace App\Models\Enums;

enum AdminRoleEnum : string
{
    case SuperAdmin = "super_admin" ;
    case Manager = "manager" ;
    case Chef = "chef" ;

    public function text() : string
    {
        return match($this) {
            AdminRoleEnum::SuperAdmin => "ادمین",
            AdminRoleEnum::Manager => "منشی",
            AdminRoleEnum::Chef => "آشپز",
        };
    }
}
