<?php

namespace App\Models;

use App\Models\Base\MongoModelParent;
use App\Models\Enums\LogTypeEnum;

class Log extends MongoModelParent
{

    protected $casts = [
        "type" => LogTypeEnum::class ,
    ];

}
