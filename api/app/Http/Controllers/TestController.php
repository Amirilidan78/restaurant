<?php

namespace App\Http\Controllers;

use App\Models\Enums\UserStateEnum;
use App\Models\MealPlan;
use App\Models\User;
use App\Services\Auth\AuthService;
use App\Services\Date\DateService;
use Illuminate\Support\Str;

class TestController extends Controller
{
    public function __invoke()
    {
        // generate 30 next days
        foreach (range(0,30) as $item) {
            $dates[] = now()->addDays($item)->toDateString() ;
        }
        // get latest plans records
        $records = MealPlan::query()->where("date",">",now()->subDay())->get(["meal_id","date"])->groupBy("date")->toArray() ;
        foreach ($records as $key => $record) {
            $records[Str::remove(" 00:00:00",$key)] = $record ;
            unset($records[$key]);
        }

        $result = [] ;
        foreach ($dates as $date) {
            if ( array_key_exists($date,$records) ) {
                $result[$date] = $records[$date][0]["meal_id"] ;
            } else {
                $result[$date] = null ;
            }
        }

        dd(
            $records ,
            $dates ,
            $result
        ) ;

        return MealPlan::query()->where("date",">",now())->get() ;
    }
}
