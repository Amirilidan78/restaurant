<?php

namespace App\Models;

use App\Models\Base\MongoModelParent;
use App\Models\Enums\OrderDeliveryTypeEnum;
use App\Models\Enums\OrderPackingTypeEnum;
use App\Models\Enums\OrderStateEnum;
use App\Models\Enums\OrderTypeEnum;
use Jenssegers\Mongodb\Relations\BelongsTo;
use Jenssegers\Mongodb\Relations\EmbedsMany;
use Jenssegers\Mongodb\Relations\EmbedsOne;

class Order extends MongoModelParent
{

    protected $casts = [
        "date" => "date"  ,
        "type" => OrderTypeEnum::class  ,
        "delivery_type" => OrderDeliveryTypeEnum::class  ,
        "packing_type" => OrderPackingTypeEnum::class  ,
        "state" => OrderStateEnum::class  ,
    ] ;

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function meal() : EmbedsOne
    {
        return $this->embedsOne(OrderItem::class);
    }

    public function product() : EmbedsOne
    {
        return $this->embedsOne(OrderItem::class);
    }

    public function products() : EmbedsMany
    {
        return $this->embedsMany(OrderItem::class);
    }
}
