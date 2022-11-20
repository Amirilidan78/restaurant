<?php

namespace App\Services\Log;

use Monolog\Formatter\NormalizerFormatter;

class LoggerFormatter extends NormalizerFormatter
{
    public function __construct()
    {
        parent::__construct();
    }

    public function format(array $record)
    {
        $record = parent::format($record);
        return $this->convertToDataBase($record);
    }

    protected function convertToDataBase(array $record)
    {
        $el = $record['extra'];
        $el['level'] = strtolower($record['level_name']);
        $el['message'] = $record['message'];
        $iteration = $record['message'];
        return $el;
    }
}
