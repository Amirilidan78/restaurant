<?php

namespace App\Http\Requests\Admin\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    public function rules()
    {
        return [
            "state" => "nullable" ,
            "admin_comment" => "nullable" ,
        ];
    }
}
