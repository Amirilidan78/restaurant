<?php

namespace App\Models;

use App\Models\Base\MongoModelParent;
use App\Models\Enums\ProductTypeEnum;

class Product extends MongoModelParent
{
    protected $casts = [
        "type" => ProductTypeEnum::class ,
    ];

}
