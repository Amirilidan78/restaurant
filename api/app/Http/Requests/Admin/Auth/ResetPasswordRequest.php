<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function rules()
    {
        return [
            "username" => "required" ,
            "token" => "required" ,
            "password" => "required" ,
        ];
    }
}
