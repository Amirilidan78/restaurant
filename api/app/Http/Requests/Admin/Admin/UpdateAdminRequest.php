<?php

namespace App\Http\Requests\Admin\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
{
    public function rules()
    {
        return [
            "first_name" => "nullable" ,
            "last_name" => "nullable" ,
            "role" => "nullable" ,
            "state" => "nullable" ,
            "password" => "nullable|min:8" ,
        ];
    }
}
