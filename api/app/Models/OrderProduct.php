<?php

namespace App\Models;

use App\Models\Base\MongoModelParent;
use Jenssegers\Mongodb\Relations\BelongsTo;

class OrderProduct extends MongoModelParent
{
    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class) ;
    }
}
