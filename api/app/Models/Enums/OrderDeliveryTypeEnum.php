<?php

namespace App\Models\Enums;

enum OrderDeliveryTypeEnum : string
{
    case InPerson = "in_person" ;
    case Courier = "courier" ;
}
