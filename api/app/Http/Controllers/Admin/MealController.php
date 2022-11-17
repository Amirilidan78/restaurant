<?php

namespace App\Http\Controllers\Admin;

use App\Extensions\SearchTable;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\Meal\StoreMealRequest;
use App\Http\Requests\Admin\Meal\UpdateMealRequest;
use App\Http\Resources\NotSecure\MealResource;
use App\Models\Meal;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class MealController extends BaseController
{

    public function all() : AnonymousResourceCollection
    {
        return MealResource::collection( Meal::all() ) ;
    }

    public function index() : AnonymousResourceCollection
    {
        return MealResource::collection( SearchTable::handle_search( Meal::query() ) ) ;
    }

    public function show(Meal $meal) : MealResource
    {
        return new MealResource($meal) ;
    }

    public function store(StoreMealRequest $request) : Response
    {
        $data = $request->validated() ;

        Meal::query()->create($data) ;

        return $this->response->ok() ;
    }

    public function update(Meal $meal, UpdateMealRequest $request) : Response
    {
        $data = $request->validated() ;

        $meal->update($data) ;

        return $this->response->ok() ;
    }

    public function delete(Meal $meal) : Response
    {
        $meal->delete() ;

        return $this->response->ok() ;
    }
}
