<?php

namespace App\Models\Enums;

enum ProductTypeEnum : string
{
    case PreOrder = "pre_order" ; // should have #pre_order_delay_hour #pre_order_min_amount
    case Store = "store" ; // should have #stock field

    public function text() : string
    {
        return match($this) {
            ProductTypeEnum::PreOrder => "سفارشی",
            ProductTypeEnum::Store => "انباری",
        };
    }
}
