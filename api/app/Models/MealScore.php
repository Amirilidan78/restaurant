<?php

namespace App\Models;

use App\Models\Base\MongoModelParent;
use Jenssegers\Mongodb\Relations\BelongsTo;
use Jenssegers\Mongodb\Relations\HasOne;

class MealScore extends MongoModelParent
{
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class) ;
    }

    public function meal_plan() : BelongsTo
    {
        return $this->belongsTo(MealPlan::class) ;
    }
}
