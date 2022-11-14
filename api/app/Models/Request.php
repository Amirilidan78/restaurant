<?php

namespace App\Models;

use App\Models\Base\MongoModelParent;
use App\Models\Enums\RequestTypeEnum;

class Request extends MongoModelParent
{

    protected $casts = [
        "type" => RequestTypeEnum::class ,
    ];

}
