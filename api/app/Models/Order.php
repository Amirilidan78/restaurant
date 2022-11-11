<?php

namespace App\Models;

use App\Models\Base\MongoModelParent;
use Jenssegers\Mongodb\Relations\BelongsTo;
use Jenssegers\Mongodb\Relations\EmbedsMany;
use Jenssegers\Mongodb\Relations\EmbedsOne;

class Order extends MongoModelParent
{
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function meal_plan() : EmbedsOne
    {
        return $this->embedsOne(MealPlan::class);
    }

    public function products() : EmbedsMany
    {
        return $this->embedsMany(Product::class);
    }
}
