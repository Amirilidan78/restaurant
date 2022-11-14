<?php

namespace App\Models;

use App\Models\Base\MongoAuthParent;
use App\Models\Enums\RequestTypeEnum;

class Request extends MongoAuthParent
{

    protected $casts = [
        "type" => RequestTypeEnum::class ,
    ];

}
