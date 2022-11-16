<?php

namespace App\Models;

use App\Models\Base\MongoModelParent;
use Jenssegers\Mongodb\Relations\BelongsTo;

class MealPlan extends MongoModelParent
{
    protected $casts = [
        "date" => "date"
    ];

    public function meal() : BelongsTo
    {
        return $this->belongsTo(Meal::class) ;
    }
}
