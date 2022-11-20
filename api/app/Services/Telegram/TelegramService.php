<?php

namespace App\Services\Telegram;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

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

    public static function report_log( string $type = "" ,string $message = "" ,array $payload = [] ,string $link = "" )
    {
        if( !self::$client )
            self::$client = new TelegramClient() ;

        $text = "" ;
        $environment = env('APP_DEBUG') == true ? "Development" : "Production" ?? "not found" ;

        $chat_id = TelegramEnum::CALL_BACK_CHAT_ID ;

        if( $type )
        {
            $text .= TelegramMessageFactory::bold( $type . "-" . $environment ) ;
        }

        if( $message )
        {
            $text .= TelegramMessageFactory::text( $message ) ;
        }

        if( $payload )
        {
            $text .= TelegramMessageFactory::code( json_encode($payload,JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT) ) ;
        }

        if( $link )
        {
            $text .= TelegramMessageFactory::link( "Click to open link!" ,$link ) ;
        }

        if( App::runningInConsole() )
        {
            $text .= TelegramMessageFactory::text( "Background job" ) ;
        }
        elseif( $current_url = url()->current() )
        {
            $text .= TelegramMessageFactory::copy( request()->ip() ) ;
            $text .= TelegramMessageFactory::copy( $current_url ) ;
        }

        $text .= TelegramMessageFactory::italic( now()->toDateTimeString() ) ;

        $text = Str::limit($text,4095) ;

        self::$client->send_message( "$text" ,$chat_id );
    }

}
