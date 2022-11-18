<?php

namespace App\Models\Enums;

enum OrderStateEnum : string
{
    case Pending = "pending" ;
    case Payed = "payed" ;
    case Cancelled = "cancelled" ;
    case Ready = "ready" ;
    case Delivered = "delivered" ;
    case Rejected = "rejected" ;

    public function text() : string
    {
        return match($this) {
            OrderStateEnum::Pending => "در انتظار پرداخت",
            OrderStateEnum::Payed => "پرداخت شده",
            OrderStateEnum::Cancelled => "لغو شده از طرف مشتری",
            OrderStateEnum::Ready => "آماده تحویل",
            OrderStateEnum::Delivered => "تحویل داده شده",
            OrderStateEnum::Rejected => "لغو شده از طرف ادمین",
        };
    }

}
