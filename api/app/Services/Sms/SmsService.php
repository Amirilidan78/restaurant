<?php

namespace App\Services\Sms;

use Illuminate\Support\Facades\Http;

class SmsService
{

    const host = "https://api.sms.ir" ;

    private static function get(string $url, array $payload = []) : array
    {
        $res = Http::withHeaders([
            "X-API-KEY" => env("SMS_SECRET") ,
            "ACCEPT" => "application/json" ,
        ])->get(self::host . $url, $payload) ;

        if ( $res->status() != 200 )
            throw new \Exception($res->json()["title"]) ;

        return $res->json() ;
    }

    private static function post(string $url, array $payload = []) : array
    {
        $res = Http::withHeaders([
            "X-API-KEY" => env("SMS_SECRET") ,
            "ACCEPT" => "application/json" ,
        ])->post(self::host . $url, $payload) ;

        if ( $res->status() != 200 )
            throw new \Exception($res->json()["title"]) ;

        return $res->json() ;
    }

    public static function Send(string $phone, string $text) : string
    {
        $res = self::post("/v1/send/bulk",[
            "lineNumber" => env("SMS_NUMBER") ,
            "MessageText" => $text ,
            "Mobiles" => [$phone] ,
        ]);

        return $res["data"]["messageIds"][0] ;
    }

    public static function SendWithTemplate(string $phone, SmsTemplate $template ,array $payload) : string
    {
        $res = self::post("/v1/send/verify",[
            "Mobile" => $phone ,
            "TemplateId" => $template->value ,
            "Parameters" => $payload ,
        ]);

        return $res["data"]["messageId"];
    }

    public static function Status(string $message_id, string $phone, string $text) : SmsDeliveryStateEnum
    {
        $res = self::get("/v1/send/$message_id",[
            "lineNumber" => env("SMS_NUMBER") ,
            "MessageText" => $text ,
            "Mobiles" => [$phone] ,
        ]);

        return SmsDeliveryStateEnum::from($res["data"]["deliveryState"] ?? 0) ;
    }

    public static function Credit() : int
    {
        $res = self::get("/v1/credit");

        return $res["data"] ;
    }

}
