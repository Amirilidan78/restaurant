<?php

namespace App\Models\Enums;

enum AdminRoleEnum : string
{
    case SuperAdmin = "super_admin" ;
    case Manager = "manager" ;
    case Chef = "chef" ;
}
