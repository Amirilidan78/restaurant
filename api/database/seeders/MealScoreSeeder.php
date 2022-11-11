<?php

namespace Database\Seeders;

use App\Models\MealPlan;
use App\Models\MealScore;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MealScoreSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run()
    {
        $scores = [] ;
        $user = User::query()->firstOrFail();
        $plans = MealPlan::all() ;
        foreach ( $plans as $plan ) {
            $scores[] = [
                [
                    "user_id" => $user["id"] ,
                    "meal_plan_id" => $plan["id"] ,
                ],
                [
                    "score" => rand(0,5) ,
                    "description" => Str::random(20)
                ]
            ];
        }

        foreach ( $scores as $score ) {
            MealScore::query()->updateOrCreate(...$score) ;
        }
    }
}
