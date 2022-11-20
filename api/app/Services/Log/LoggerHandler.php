<?php

namespace App\Services\Log ;

use App\Models\Enums\LogTypeEnum;
use App\Models\Log;
use App\Services\Telegram\TelegramService;
use Monolog\Formatter\FormatterInterface;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

class LoggerHandler extends AbstractProcessingHandler
{
    public function __construct($level = Logger::DEBUG, bool $bubble = true)
    {
        parent::__construct($level, $bubble);
    }

    protected function write( array $record ): void
    {
        Log::query()->create([
            "type" => LogTypeEnum::System ,
            ...$record
        ]) ;

        if( $record['level_name'] == "ERROR" ) // ERROR
        {
            $context = [
                'file' => $record['context']['exception']->getFile() ,
                'line' => $record['context']['exception']->getLine() ,
                'code' => $record['context']['exception']->getCode() ,
            ] ;

            TelegramService::report_log( $record['level_name'] ,$record['context']['exception']->getMessage() ,$context ) ;
        }
        else
        {
            TelegramService::report_log( $record['level_name'] ,$record['message'] ,array_merge( $record['context'] ,$record['formatted'] ) );
        }
    }

    protected function getDefaultFormatter(): FormatterInterface
    {
        return new LoggerFormatter();
    }
}
