<?php

namespace App\Services\Log;

use App\Models\Enums\LogTypeEnum;
use App\Models\Log;
use App\Services\Auth\AuthService;
use Illuminate\Support\Facades\DB;

class LogService
{

    public static function StoreAdminLog() : void
    {
        $model = AuthService::GetAuthenticatedEntity() ;

        Log::query()->insert([
            "type" => LogTypeEnum::AdminActivity ,
            "admin_username" => $model->username ,
            "url" => request()->path() ,
            "ip" => request()->ip() ,
            "payload" => request()->all() ,
            "query" => DB::getQueryLog() ,
            "created_at" => now()->toDateTimeString() ,
            "updated_at" => now()->toDateTimeString() ,
        ]) ;
    }

}
