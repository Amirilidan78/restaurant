<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ValidateForgotPasswordRequest extends FormRequest
{
    public function rules()
    {
        return [
            "token" => "required" ,
        ];
    }
}
