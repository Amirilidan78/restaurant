<?php

namespace App\Services\Date;

use Illuminate\Support\Carbon;
use Morilog\Jalali\Jalalian;

class DateService
{
    public static function DateToDate( string $date ) : string
    {
        return Carbon::create($date)->format(env("DATE_FORMAT")) ;
    }

    public static function DateToJalaliDate( string $date ) : string
    {
        return Jalalian::fromCarbon(Carbon::create($date))->format(env("DATE_FORMAT")) ;
    }

    public static function DateToJalaliHuman( string $date ) : string
    {
        return Jalalian::fromCarbon(Carbon::create($date))->ago() ;
    }

    public static function CarbonToDate( Carbon $date ) : string
    {
        return $date->format(env("DATE_FORMAT")) ;
    }

    public static function CarbonToJalaliDate( Carbon $date ) : string
    {
        return Jalalian::fromCarbon($date)->format(env("DATE_FORMAT")) ;
    }

    public static function JalaliDateToDate( string $date ) : string
    {
        return Jalalian::fromFormat(env("DATE_FORMAT"),$date)->toCarbon()->format(env("DATE_FORMAT")) ;
    }
}
