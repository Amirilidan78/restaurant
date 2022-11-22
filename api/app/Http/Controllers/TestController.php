<?php

namespace App\Http\Controllers;

use App\Models\Enums\OrderStateEnum;
use App\Models\Enums\OrderTypeEnum;
use App\Models\Order;
use App\Services\Date\DateService;

class TestController extends Controller
{
    public function __invoke()
    {
        $dates = [
            DateService::CarbonToDate(now()) ,
            DateService::CarbonToDate(now()->addDay()) ,
            DateService::CarbonToDate(now()->addDays(2)) ,
            DateService::CarbonToDate(now()->addDays(3)) ,
        ] ;

        foreach ( $dates as $date ) {

            $records = Order::query()
                ->where("type",OrderTypeEnum::Meal->value)
                ->where("state",OrderStateEnum::Pending->value)
                ->where("date",$date)
                ->get()
                ->map( fn( $item ) => [  "meal" => $item["meal"]?->toArray() ,"products" => $item["products"]?->toArray() ]) ;

            $meal = [ "name" => "", "quantity" => 0 ] ;
            $products = [] ;

            foreach ( $records as $record ) {

                $meal["name"] = $record["meal"]["name"] ;
                $meal["quantity"] = $meal["quantity"] + $record["meal"]["quantity"] ;

                foreach ( $record["products"] as $product ) {
                    $products[$product['item_id']] = [
                        "name" => $product["name"] ,
                        "quantity" => $products[$product["item_id"]]["quantity"] ?? 0 + $product["quantity"] ,
                    ] ;
                }

            }

            $final[$date] = [
                "meal" => $meal ,
                "products" => $products ,
            ] ;
        }


        return 1 ;
    }
}
