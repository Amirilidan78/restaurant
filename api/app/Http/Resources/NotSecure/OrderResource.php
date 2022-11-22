<?php

namespace App\Http\Resources\NotSecure;

use App\Http\Resources\ResourceCore;
use App\Services\Date\DateService;

class OrderResource extends ResourceCore
{
    public function toArray($request)
    {
        return [
            "id" => $this["id"] ,
            "user_id" => $this["user_id"] ,
            "total_price" => $this["total_price"] ,
            "description" => $this["description"] ,
            "admin_comment" => $this["admin_comment"] ,
            "total_price_string" => number_format($this["total_price"],0,".",",") ,
            "date" => $this["date"] ,
            "date_jalali" => DateService::DateToJalaliDate($this["date"]) ,
            "packing_type" => $this["packing_type"]?->value ,
            "packing_type_text" => $this["packing_type"]?->text() ,
            "delivery_type" => $this["delivery_type"]?->value ,
            "delivery_type_text" => $this["delivery_type"]?->text() ,
            "type" => $this["type"]?->value ,
            "type_text" => $this["type"]?->text() ,
            "state" => $this["state"]?->value ,
            "state_text" => $this["state"]?->text() ,
            "products" => OrderItemResource::collection($this->whenLoaded("products")) ,
            "user" => new UserResource($this->whenLoaded("user")) ,
            "product" => new OrderItemResource($this->whenLoaded("product")) ,
            "meal" => new OrderItemResource($this->whenLoaded("meal")) ,
        ];
    }
}
