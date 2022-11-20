<?php

namespace App\Http\Controllers;

use App\Models\Enums\UserStateEnum;
use App\Models\MealPlan;
use App\Models\User;
use App\Services\Auth\AuthService;
use App\Services\Date\DateService;
use App\Services\Sms\SmsService;
use App\Services\Sms\SmsTemplate;
use App\Services\Telegram\TelegramService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TestController extends Controller
{
    public function __invoke()
    {
        // SmsService::Send("09370843199","سلام");
        // SmsService::Credit()

        Log::info("123") ;

        dd(
            1
        ) ;

        return MealPlan::query()->where("date",">",now())->get() ;
    }
}
