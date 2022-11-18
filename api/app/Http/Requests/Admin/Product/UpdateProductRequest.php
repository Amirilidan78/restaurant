<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            "name" => "nullable" ,
            "description" => "nullable" ,
            "images" => "nullable" ,
            "price" => "nullable" ,
            "has_stock" => "nullable" ,
            "stock" => "required_if:has_stock,true" ,
            "can_preorder" => "nullable" ,
            "preorder_delay_day" => "required_if:can_preorder,true" ,
            "preorder_min_amount" => "required_if:can_preorder,true" ,
        ];
    }
}
