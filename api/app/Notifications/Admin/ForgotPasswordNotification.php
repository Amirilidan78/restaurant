<?php

namespace App\Notifications\Admin;

use App\Notifications\Channels\SmsChannel;
use App\Notifications\NotificationCore;
use App\Services\Sms\SmsTemplate;

class ForgotPasswordNotification extends NotificationCore
{
    public string $title = "فراموشی رمز عبور" ;

    public array $channels = [ SmsChannel::class ];

    public function __construct(public string $token)
    {}

    public function toSms($notifiable) : array
    {
        return [
            "template_id" => SmsTemplate::ForgotPassword ,
            "payload" => [
                [
                    "Name" => "TOKEN" ,
                    "Value" => $this->token ,
                ],
            ] ,
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            "title" => $this->title ,
            "type" => ForgotPasswordNotification::class ,
        ];
    }
}
