<?php

namespace App\Http\Controllers\Admin;

use App\Extensions\SearchTable;
use App\Http\Controllers\BaseController;
use App\Http\Resources\NotSecure\OrderResource;
use App\Models\Enums\OrderStateEnum;
use App\Models\Enums\OrderTypeEnum;
use App\Models\Order;
use App\Services\Date\DateService;
use App\Services\Sms\SmsService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class DashboardController extends BaseController
{
    public function getDailyMealsAndProducts() : Response
    {
        $dates = [
            DateService::CarbonToDate(now()) ,
            DateService::CarbonToDate(now()->addDay()) ,
            DateService::CarbonToDate(now()->addDays(2)) ,
            DateService::CarbonToDate(now()->addDays(3)) ,
        ] ;

        foreach ( $dates as $date ) {

            $records = Order::query()
                ->where(fn( Builder $q ) => $q->where("type",OrderTypeEnum::Meal->value)->orWhere("type",OrderTypeEnum::Preorder->value))
                ->where("state",OrderStateEnum::Payed->value)
                ->where("date",$date)
                ->get()
                ->map( fn( $item ) => [
                    "meal" => $item["meal"]?->toArray() ,
                    "products" => $item["products"]?->toArray() ,
                ]) ;

            $meal = [ "name" => "", "quantity" => 0 ] ;
            $products = [] ;

            foreach ( $records as $record ) {

                // OrderTypeEnum::Meal
                if( array_key_exists("meal",$record) && $record["meal"] )
                {
                    $meal["name"] = $record["meal"]["name"] ;
                    $meal["quantity"] = $meal["quantity"] + $record["meal"]["quantity"] ;
                }

                // OrderTypeEnum::Meal
                if( array_key_exists("products",$record) && $record["products"] ) {
                    foreach ( $record["products"] as $product ) {
                        $products[$product['item_id']] = [
                            "name" => $product["name"] ,
                            "quantity" => $products[$product["item_id"]]["quantity"] ?? 0 + $product["quantity"] ,
                        ] ;
                    }
                }

                // OrderTypeEnum::Preorder
                if( array_key_exists("product",$record) && $record["product"] ) {
                    $products[$record["product"]['item_id']] = [
                        "name" => $record["product"]["name"] ,
                        "quantity" => $record["product"]["quantity"] ,
                    ] ;
                }

            }

            $final[DateService::DateToJalaliDate($date)] = [
                "date" => $date ,
                "meal" => $meal["name"] == "" ? null : $meal ,
                "products" => $products ? $products : null  ,
            ] ;
        }

        return $this->response->ok([
            "data" => $final
        ]) ;
    }

    public function getLatestOrders() : AnonymousResourceCollection
    {
        return OrderResource::collection( SearchTable::handle_search( Order::query()->with(["user","meal","product","products"])->orderBy("created_at","desc")) ) ;
    }

    public function getDailyOrders(string $date = "") : AnonymousResourceCollection
    {
        if ( !$date )
            $date =  DateService::CarbonToDate(now()) ;
        else
            $date =  DateService::JalaliDateToDate($date) ;

        return OrderResource::collection( SearchTable::handle_search( Order::query()->with(["user","meal","product","products"])->where("date",$date) ) ) ;
    }

    public function getSmsCredit() : Response
    {
        return $this->response->ok([
            "credit" => SmsService::Credit()
        ]) ;
    }

}
