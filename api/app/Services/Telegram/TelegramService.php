<?php

namespace App\Services\Telegram;

class TelegramService
{
    public static TelegramClient|null $client = null ;

    public static function get_client()
    {
        if( !self::$client )
            self::$client = new TelegramClient() ;

        return self::$client ;
    }

    public static function send_message( string $text , string $chat_id = TelegramEnum::CALL_BACK_CHAT_ID ) : array
    {
        if( !self::$client )
            self::$client = new TelegramClient() ;

        return self::$client->send_message( $text, $chat_id, [] );
    }

}
