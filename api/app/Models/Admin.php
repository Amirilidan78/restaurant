<?php

namespace App\Models;

use App\Models\Base\MongoAuthParent;
use App\Models\Enums\AdminRoleEnum;
use App\Models\Enums\AdminStateEnum;

class Admin extends MongoAuthParent
{

    protected $casts = [
        "state" => AdminStateEnum::class ,
        "role" => AdminRoleEnum::class ,
    ];

}
