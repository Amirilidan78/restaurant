<?php

namespace App\Http\Requests\Admin\Meal;

use Illuminate\Foundation\Http\FormRequest;

class StoreMealRequest extends FormRequest
{
    public function rules()
    {
        return [
            "name" => "required" ,
            "description" => "required" ,
            "images" => "required" ,
            "price" => "required" ,
        ];
    }
}
