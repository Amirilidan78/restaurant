<?php

namespace App\Http\Requests\Admin\MealScore;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMealScoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            "is_accepted" => "required" ,
        ];
    }
}
