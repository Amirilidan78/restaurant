<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            "name" => "required" ,
            "type" => "required" ,
            "description" => "required" ,
            "images" => "required" ,
            "price" => "required" ,
            "stock" => "nullable" ,
            "pre_order_delay_day" => "nullable" ,
            "pre_order_min_amount" => "nullable" ,
        ];
    }
}
