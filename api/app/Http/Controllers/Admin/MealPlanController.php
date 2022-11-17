<?php

namespace App\Http\Controllers\Admin;

use App\Extensions\SearchTable;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\Meal\StoreMealRequest;
use App\Http\Requests\Admin\Meal\UpdateMealRequest;
use App\Http\Requests\Admin\MealPlan\UpdateNextMonthMealPlansRequest;
use App\Http\Resources\NotSecure\MealPlanResource;
use App\Models\Meal;
use App\Models\MealPlan;
use App\Services\Date\DateService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class MealPlanController extends BaseController
{

    public function index() : AnonymousResourceCollection
    {
        return MealPlanResource::collection( SearchTable::handle_search( MealPlan::query()->with(["meal"]) ) ) ;
    }

    public function getNextMonthPlans() : Response
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
                $result[DateService::DateToJalaliDate($date)] = $records[$date][0]["meal_id"] ;
            } else {
                $result[DateService::DateToJalaliDate($date)] = null ;
            }
        }

        return $this->response->ok([
            "data" => $result
        ]) ;
    }

    public function updateNextMonthPlans(UpdateNextMonthMealPlansRequest $request) : Response
    {
        $data = $request->validated() ;

        foreach ( $data["plans"] as $key => $item ) {
            $plans[DateService::JalaliDateToDate($key)] = $item ;
        }

        foreach ( $plans as $date => $meal_id ) {
            MealPlan::query()->updateOrCreate(
                [
                    "date" => $date ,
                ],
                [
                    "meal_id" => $meal_id ,
                ]
            );
        }

        return $this->response->ok() ;
    }


}
