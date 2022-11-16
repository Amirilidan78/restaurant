<?php

namespace App\Services\Date;

use Illuminate\Support\Carbon;
use Morilog\Jalali\Jalalian;

class DateService
{
    public static function CarbonToDate( Carbon $date ) : string
    {
        return $date->format(env("DATE_FORMAT")) ;
    }

    public static function CarbonToJalaliDate( Carbon $date ) : string
    {
        return Jalalian::fromCarbon($date)->format(env("DATE_FORMAT")) ;
    }
}
