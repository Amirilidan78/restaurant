<?php

namespace App\Models\Enums;

enum OrderTypeEnum : string
{
    case Meal = "meal" ;
    case Store = "store" ;
    case Preorder = "preorder" ;

    public function text() : string
    {
        return match($this) {
            OrderTypeEnum::Meal => "برنامه غذایی",
            OrderTypeEnum::Store => "انبار",
            OrderTypeEnum::Preorder => "پیش خرید",
        };
    }

}
