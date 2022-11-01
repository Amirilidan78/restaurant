<?php

namespace App\Http\Requests\User\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            "name" => "required" ,
            "phone" => "required" ,
            "password" => "required" ,
        ];
    }
}
