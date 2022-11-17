<?php

namespace Database\Seeders;

use App\Models\Enums\OrderDeliveryTypeEnum;
use App\Models\Enums\OrderItemTypeEnum;
use App\Models\Enums\OrderPackingTypeEnum;
use App\Models\Enums\OrderStateEnum;
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
        $product = Product::query()->firstOrFail() ;
        $users = User::all() ;
        foreach ($users as $user) {
            $model = Order::query()->updateOrCreate(
                [
                    "user_id" => $user["id"] ,
                ],
                [
                    "delivery_type" => OrderDeliveryTypeEnum::InPerson ,
                    "packing_type" => OrderPackingTypeEnum::PlasticContainer ,
                    "state" => OrderStateEnum::Pending ,
                    "date" => DateService::CarbonToDate(now()) ,
                    "description" => Str::random(40)
                ]
            ) ;
            $model->items()->create([
                "type" => OrderItemTypeEnum::Meal ,
                "meal_id" => $meal["id"] ,
                "quantity" => rand(1,20) ,
                "price" => $meal["price"] ,
            ]) ;
            $model->items()->create([
                "type" => OrderItemTypeEnum::Product ,
                "product_id" => $product["id"] ,
                "quantity" => rand(1,20) ,
                "price" => $product["price"] ,
            ]) ;
        }
    }
}
