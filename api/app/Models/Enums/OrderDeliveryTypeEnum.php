<?php

namespace App\Models\Enums;

enum OrderDeliveryTypeEnum : string
{
    case InPerson = "in_person" ;
    case Courier = "courier" ;

    public function text() : string
    {
        return match($this) {
            OrderDeliveryTypeEnum::InPerson => "حضوری",
            OrderDeliveryTypeEnum::Courier => "پیک",
        };
    }

}
