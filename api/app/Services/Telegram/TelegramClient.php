<?php

namespace App\Services\Telegram;

use Illuminate\Support\Facades\Http;

class TelegramClient
{

    private function get_base_url() : string
    {
        $token = TelegramEnum::BOT_API_TOKEN ;
        return "https://api.telegram.org/bot{$token}/" ;
    }

    public function send_message( string $text , string $chat_id = '' ,array $keyboards = [] ) : array
    {
        try
        {
            if( !$chat_id )
                $chat_id = TelegramEnum::CALL_BACK_CHAT_ID ;

            $url = $this->get_base_url() . "sendMessage" ;

            $params = [
                "chat_id" => $chat_id ,
                "text" => $text ,
                'parse_mode' => 'html',
            ];

            $response = Http::get($url ,$params)->throw() ;

            return $response->json() ;
        }
        catch ( \Exception $exception )
        {
            return [ 'exception' => $exception ] ;
        }
    }

    public function send_bare_message( string $cmd ,array $payload ) : array
    {
        $url = $this->get_base_url() . $cmd ;

        $params = $payload;

        $res =  Http::get($url ,$params) ;

        return $res->json() ;
    }

}
