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
            "price" => $this["price"] ,
            "price_string" => number_format($this["price"],0,".",",") ,
            "has_stock" => (bool)$this["has_stock"] ,
            "stock" => $this["stock"] ,
            "can_preorder" => (bool)$this["can_preorder"] ,
            "preorder_delay_day" => $this["preorder_delay_day"] ,
            "preorder_min_amount" => $this["preorder_min_amount"] ,
            "images" => $this["images"] ,
        ];
    }
}
