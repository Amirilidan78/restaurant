<?php

namespace App\Notifications\Channels;

use Illuminate\Notifications\Notification;

class DatabaseChannel
{
    public function send($notifiable, Notification $notification)
    {
        try {

            $message = $notification->toDatabase($notifiable);

            $this->store_db($notification ,$notifiable ,$message);

        }
        catch ( \Exception $exception )
        {
            report( $exception );
        }
    }

    public function store_db( $notification ,$notifiable ,$message ) : void
    {
        $notifiable->notifications()->create([
            "title" => $message['title'] ,
            "type" => $message['type'] ,
            "notification_id" => $notification->id ,
            // === sms === //
            "sms_notified" => null ,
            "sms_error" => null ,
            'sms_id' => null ,
            'sms_phone' => null ,
            'sms_log' => null ,
        ]);
    }


}
