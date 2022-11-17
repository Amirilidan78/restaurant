<?php

namespace App\Http\Requests\Admin\MealPlan;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNextMonthMealPlansRequest extends FormRequest
{
    public function rules()
    {
        return [
            "plans" => "required" ,
        ];
    }
}
