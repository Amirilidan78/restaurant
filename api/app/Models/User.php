<?php

namespace App\Models;

use App\Models\Base\MongoAuthParent;
use App\Models\Enums\UserGenderEnum;
use App\Models\Enums\UserStateEnum;
use Jenssegers\Mongodb\Relations\HasMany;

class User extends MongoAuthParent
{

    protected $casts = [
      "gender" => UserGenderEnum::class ,
      "state" => UserStateEnum::class ,
      "birth_date" => "date" ,
    ];

    public function notifications() : HasMany
    {
        return $this->hasMany( UserNotification::class  ) ;
    }

    public function orders() : HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function meal_score() : HasMany
    {
        return $this->hasMany(MealScore::class);
    }

}
