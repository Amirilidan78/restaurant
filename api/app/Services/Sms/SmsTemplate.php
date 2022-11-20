<?php

namespace App\Services\Sms;

enum SmsTemplate : int
{
    case Code = 383473 ; // parameters => [ code ]
    case ForgotPassword = 327414 ; // parameters => [ token ]
}
