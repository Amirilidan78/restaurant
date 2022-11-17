<?php

namespace App\Http\Resources\NotSecure;

use App\Http\Resources\ResourceCore;

class ProductResource extends ResourceCore
{
    public function toArray($request)
    {
        return [
            "id" => $this["id"] ,
            "name" => $this["name"] ,
            "description" => $this["description"] ,
            "type" => $this["type"]?->value ,
            "type_text" => $this["type"]?->text() ,
            "price" => $this["price"] ,
            "price_string" => number_format($this["price"],0,".",",") ,
            "stock" => $this["stock"] ,
            "pre_order_delay_day" => $this["pre_order_delay_day"] ,
            "pre_order_min_amount" => $this["pre_order_min_amount"] ,
            "images" => $this["images"] ,
        ];
    }
}
