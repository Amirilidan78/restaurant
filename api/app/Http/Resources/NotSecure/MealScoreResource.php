<?php

namespace App\Http\Resources\NotSecure;

use App\Http\Resources\ResourceCore;

class MealScoreResource extends ResourceCore
{
    public function toArray($request)
    {
        return [
            "id" => $this["id"] ,
            "user_id" => $this["user_id"] ,
            "score" => $this["score"] ,
            "description" => $this["description"] ,
            "user" => new UserResource($this->whenLoaded("user")) ,
            "meal_plan" => new MealPlanResource($this->whenLoaded("meal_plan")) ,
        ];
    }
}
