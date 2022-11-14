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
            "stock" => "required" ,
        ];
    }
}
