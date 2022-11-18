<?php

namespace App\Services\Sms;

enum SmsDeliveryStateEnum : int
{
    case Pending = 0 ;
    case Success = 1 ;
    case Failed = 2 ;
    case ProgressInTelecommunications = 3 ;
    case ErrorInTelecommunications = 4 ;
    case SentToTelecommunications = 5 ;
    case Error = 6 ;
    case BlackList = 7 ;
}
