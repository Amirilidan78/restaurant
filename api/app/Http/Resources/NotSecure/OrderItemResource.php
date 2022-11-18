<?php

namespace App\Http\Resources\NotSecure;

use App\Http\Resources\ResourceCore;

class OrderItemResource extends ResourceCore
{
    public function toArray($request)
    {
        return [
            "id" => $this["id"] ,
            "name" => $this["name"] ,
            "price" => $this["price"] ,
            "quantity" => $this["quantity"] ,
            "item_id" => $this["item_id"] ,
        ];
    }
}
