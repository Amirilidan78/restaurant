<?php

namespace Database\Seeders;

use App\Models\Enums\OrderDeliveryTypeEnum;
use App\Models\Enums\OrderPackingTypeEnum;
use App\Models\Enums\OrderStateEnum;
use App\Models\Enums\OrderTypeEnum;
use App\Models\Meal;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\Date\DateService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run()
    {
        $meal = Meal::query()->firstOrFail() ;
        $products = Product::query()->take(3)->get() ;
        $user = User::query()->firstOrFail() ;

        // -------------- order type meal -------------- //
        $model = Order::query()->updateOrCreate(
            [
                "type" => OrderTypeEnum::Meal ,
            ],
            [
                "user_id" => $user["id"] ,
                "total_price" => rand(100000,300000) ,
                "delivery_type" => OrderDeliveryTypeEnum::InPerson ,
                "packing_type" => OrderPackingTypeEnum::PlasticContainer ,
                "state" => OrderStateEnum::Pending ,
                "date" => DateService::CarbonToDate(now()) ,
                "description" => Str::random(40) ,
                "admin_comment" => "" ,
            ],
        ) ;
        $model->meal()->create([
            "item_id" => $meal["id"] ,
            "name" => $meal["name"] ,
            "price" => $meal["price"] ,
            "quantity" => rand(1,10) ,
        ]) ;
        foreach ($products as $product) {
            $model->products()->create([
                "item_id" => $product["id"] ,
                "name" => $product["name"] ,
                "price" => $product["price"] ,
                "quantity" => rand(1,10) ,
            ]) ;
        }

        // -------------- order type store -------------- //
        $model = Order::query()->updateOrCreate(
            [
                "type" => OrderTypeEnum::Store ,
            ],
            [
                "user_id" => $user["id"] ,
                "total_price" => rand(100000,300000) ,
                "delivery_type" => OrderDeliveryTypeEnum::InPerson ,
                "packing_type" => OrderPackingTypeEnum::PlasticContainer ,
                "state" => OrderStateEnum::Pending ,
                "date" => DateService::CarbonToDate(now()) ,
                "description" => Str::random(40) ,
                "admin_comment" => "" ,
            ],
        ) ;
        foreach ($products as $product) {
            $model->products()->create([
                "item_id" => $product["id"] ,
                "name" => $product["name"] ,
                "price" => $product["price"] ,
                "quantity" => rand(1,10) ,
            ]) ;
        }

        // -------------- order Preorder store -------------- //
        $model = Order::query()->updateOrCreate(
            [
                "type" => OrderTypeEnum::Preorder ,
            ],
            [
                "user_id" => $user["id"] ,
                "total_price" => rand(100000,300000) ,
                "delivery_type" => OrderDeliveryTypeEnum::InPerson ,
                "packing_type" => OrderPackingTypeEnum::PlasticContainer ,
                "state" => OrderStateEnum::Pending ,
                "date" => DateService::CarbonToDate(now()) ,
                "description" => Str::random(40) ,
                "admin_comment" => "" ,
            ],
        ) ;
        $model->product()->create([
            "item_id" => $products[0]["id"] ,
            "name" => $products[0]["name"] ,
            "price" => $products[0]["price"] ,
            "quantity" => rand(1,10) ,
        ]) ;


    }
}
