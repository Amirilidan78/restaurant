<?php

namespace App\Models;

use App\Models\Base\MongoModelParent;
use App\Models\Enums\OrderItemTypeEnum;
use Jenssegers\Mongodb\Relations\BelongsTo;

class OrderItem extends MongoModelParent
{
    protected $casts = [
        "type" => OrderItemTypeEnum::class
    ];

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class) ;
    }

    public function meal() : BelongsTo
    {
        return $this->belongsTo(Meal::class) ;
    }
}
