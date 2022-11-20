<?php

namespace App\Services\Telegram;

class TelegramMessageFactory
{

    public static function text( string $text ) : string
    {
        return "$text \n";
    }

    public static function bold( string $text ) : string
    {
        return "<b>$text</b>  \n";
    }

    public static function italic( string $text ) : string
    {
        return "<i>$text</i>\n";
    }

    public static function strike( string $text ) : string
    {
        return "<s>$text</s>\n";
    }

    public static function underline( string $text ) : string
    {
        return "<u>$text</u>\n";
    }

    public static function spoiler( string $text ) : string
    {
        return "<tg-spoiler>$text</tg-spoiler>\n";
    }

    public static function link( string $text ,string $url ) : string
    {
        return "<a href='$url'>$text</a>\n";
    }

    public static function code( string $text ) : string
    {
        return "<pre>$text</pre>\n";
    }

    public static function copy( string $text ) : string
    {
        return "<code>$text</code>\n";
    }

    public static function separator() : string
    {
        return "<pre>-------------------------------</pre>";
    }

}
