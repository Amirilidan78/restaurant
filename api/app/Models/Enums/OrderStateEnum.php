<?php

namespace App\Models\Enums;

enum OrderStateEnum : string
{
    case Pending = "pending" ;
    case Accepted = "accepted" ;
    case Ready = "ready" ;
    case Delivered = "delivered" ;
    case Cancelled = "cancelled" ;
    case Rejected = "rejected" ;
}
