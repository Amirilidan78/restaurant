<?php

namespace App\Models;

use App\Models\Base\MongoModelParent;
use Jenssegers\Mongodb\Relations\BelongsTo;

class OrderItem extends MongoModelParent
{
//    public function product() : BelongsTo
//    {
//        return $this->belongsTo(Product::class) ;
//    }
//
//    public function meal() : BelongsTo
//    {
//        return $this->belongsTo(Meal::class) ;
//    }
}
