<?php

namespace App\Http\Resources\NotSecure;

use App\Http\Resources\ResourceCore;

class NotificationResource extends ResourceCore
{
    public function toArray($request)
    {
        return [
            'id' => $this['id'] ,
            "notification_id" => $this["notification_id"] ,
            "title" => $this["title"] ,
            "type" => $this["type"] ,
            // === sms === //
            "sms_notified" => $this["sms_notified"] ,
            "sms_error" => $this["sms_error"] ,
            'sms_id' => $this["sms_id"] ,
            'sms_phone' => $this["sms_phone"] ,
            'sms_log' => $this["sms_log"] ,
            "user" => new UserResource($this->whenLoaded("user")) ,
            "admin" => new AdminResource($this->whenLoaded("admin")) ,
        ];

    }
}
