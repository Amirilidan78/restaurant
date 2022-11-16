<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            "name" => "required" ,
            "description" => "required" ,
            "images" => "required" ,
            "price" => "required" ,
            "stock" => "required" ,
        ];
    }
}
