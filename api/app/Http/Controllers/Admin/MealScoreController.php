<?php

namespace App\Http\Controllers\Admin;

use App\Extensions\SearchTable;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\MealScore\UpdateMealScoreRequest;
use App\Http\Resources\NotSecure\MealScoreResource;
use App\Models\MealScore;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Jenssegers\Mongodb\Query\Builder;
use Jenssegers\Mongodb\Relations\EmbedsOne;

class MealScoreController extends BaseController
{

    public function index() : AnonymousResourceCollection
    {
        return MealScoreResource::collection( SearchTable::handle_search( MealScore::query()->with([
            "user",
            "meal_plan" => [
                "meal"
            ],
        ]))) ;
    }

    public function show(MealScore $meal_score) : MealScoreResource
    {
        return new MealScoreResource($meal_score) ;
    }

    public function update(MealScore $meal_score, UpdateMealScoreRequest $request) : Response
    {
        $data = $request->validated() ;

        $meal_score->update($data) ;

        return $this->response->ok() ;
    }

    public function delete(MealScore $meal_score) : Response
    {
        $meal_score->delete() ;

        return $this->response->ok() ;
    }
}
