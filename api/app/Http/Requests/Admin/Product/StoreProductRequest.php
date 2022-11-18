<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            "name" => "required" ,
            "description" => "required" ,
            "images" => "required" ,
            "price" => "required" ,
            "has_stock" => "required" ,
            "stock" => "required_if:has_stock,true" ,
            "can_preorder" => "required" ,
            "preorder_delay_day" => "required_if:can_preorder,true" ,
            "preorder_min_amount" => "required_if:can_preorder,true" ,
        ];
    }
}
