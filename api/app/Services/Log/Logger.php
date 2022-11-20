<?php

namespace App\Services\Log ;

use Monolog\Logger as MonoLogger;

class Logger
{
    public function __invoke() : MonoLogger
    {
        $logger = new MonoLogger('app logger');
        $handler = new LoggerHandler();
        $processor = new LoggerProcessor();
        $logger->pushHandler($handler);
        $logger->pushProcessor($processor);
        return $logger;
    }
}
