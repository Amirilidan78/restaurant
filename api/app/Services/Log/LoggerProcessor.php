<?php

namespace App\Services\Log;

use App\Services\Auth\AuthService;

class LoggerProcessor
{

    public function __invoke(array $record): array
    {
        $model = AuthService::GetAuthenticatedEntity() ;

        $record['extra']['user'] = $model ? $model->toArray() : "guest" ;

        return $record;
    }
}
