<?php

namespace App\Http\Controllers;

use App\Models\Enums\UserStateEnum;
use App\Models\MealPlan;
use App\Models\User;
use App\Services\Auth\AuthService;
use App\Services\Date\DateService;
use App\Services\Sms\SmsService;
use App\Services\Sms\SmsTemplate;
use Illuminate\Support\Str;

class TestController extends Controller
{
    public function __invoke()
    {
        // SmsService::Send("09370843199","سلام");
        // SmsService::Credit()


        $id = SmsService::SendWithTemplate("09370843199",SmsTemplate::Code, [
            [
                "Name" => "CODE" ,
                "Value" => "1234" ,
            ]
        ]);

        dd(
            $id
        ) ;

        return MealPlan::query()->where("date",">",now())->get() ;
    }
}
