<?php

namespace App\Http\Requests\Admin\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function rules()
    {
        return [
            "first_name" => "required" ,
            "last_name" => "required" ,
            "phone" => "required" ,
            "email" => "required" ,
            "avatar" => "required" ,
        ];
    }
}
