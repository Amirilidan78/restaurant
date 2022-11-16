<?php

namespace App\Http\Resources\NotSecure;

use App\Http\Resources\ResourceCore;
use App\Services\Date\DateService;

class MealPlanResource extends ResourceCore
{
    public function toArray($request)
    {
        return [
            "id" => $this["id"] ,
            "meal_id" => $this["meal_id"] ,
            "date" => DateService::CarbonToDate($this["date"]) ,
            "date_jalali" => DateService::CarbonToJalaliDate($this["date"]) ,
            "meal" => new MealResource($this->whenLoaded("meal")) ,
        ];
    }
}
