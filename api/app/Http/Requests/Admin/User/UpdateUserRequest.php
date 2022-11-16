<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            "first_name" => "required" ,
            "last_name" => "required" ,
            "gender" => "required" ,
            "phone" => "required" ,
            "address" => "required" ,
            "state" => "required" ,
        ];
    }
}
