<?php

namespace App\Models;

use App\Models\Base\MongoModelParent;
use Jenssegers\Mongodb\Relations\HasMany;

class Meal extends MongoModelParent
{
    public function meal_plans() : HasMany
    {
        return $this->hasMany(MealPlan::class) ;
    }
}
