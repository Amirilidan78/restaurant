<?php

namespace App\Notifications\Channels;

use App\Models\AdminNotification;
use App\Models\User;
use App\Models\UserNotification;
use App\Services\Sms\SmsService;
use Illuminate\Notifications\Notification;


class SmsChannel
{

    public function send($notifiable, Notification $notification)
    {
        try {

            $message = $notification->toSms($notifiable);

            if( empty( $notifiable['phone'] ) )
                throw new \Exception("شماره همراه کاربر یافت نشد");

            $result = $this->notify_sms( $notifiable ,$message) ;

            $this->update_db( $notification ,$notifiable ,$message ,$result );
        }
        catch ( \Exception $exception )
        {
            report( $exception );
            $this->error_db( $notification, $message ,$notifiable ,$exception );
        }
    }

    private function notify_sms( $notifiable ,$message ) : string
    {
        return SmsService::SendWithTemplate($notifiable['phone'],$message["template_id"],$message["payload"]);
    }

    private function update_db( $notification ,$notifiable ,$message ,string $sms_id ) : void
    {
        $query = $notifiable instanceof User ? UserNotification::query() : AdminNotification::query() ;

        $notification_model = $query->where("notification_id",$notification->id)->firstOrFail();

        $notification_model->update([
            'sms_notified' => true ,
            'sms_error' => null ,
            'sms_id' => $sms_id ,
            'sms_phone' => $notifiable['phone'] ,
            'sms_template' => $message['template_id'] ,
            'sms_payload' => $message['payload'] ,
        ]);
    }

    private function error_db( $notification, $notifiable, $message, \Exception $exception ) : void
    {
        $query = $notifiable instanceof User ? UserNotification::query() : AdminNotification::query() ;

        $notification_model = $query->where("notification_id",$notification->id)->firstOrFail();

        $notification_model->update([
            "sms_notified" => false ,
            "sms_error" => $exception->getMessage() ,
            'sms_id' => null ,
            'sms_phone' => $message['phone'] ,
            'sms_log' => $message['text'] ,
        ]);
    }

}
