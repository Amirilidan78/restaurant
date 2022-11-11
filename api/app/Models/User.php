<?php

namespace App\Models;

use App\Models\Base\MongoAuthParent;
use App\Models\Enums\UserGenderEnum;
use App\Models\Enums\UserStateEnum;

class User extends MongoAuthParent
{

    protected $casts = [
      "gender" => UserGenderEnum::class ,
      "state" => UserStateEnum::class ,
    ];

}
