<?php

namespace App\Http\Requests\Admin\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
{
    public function rules()
    {
        return [
            "first_name" => "required" ,
            "last_name" => "required" ,
            "username" => "required|unique:admins,username" ,
            "role" => "required" ,
            "password" => "required|min:8" ,
        ];
    }
}
