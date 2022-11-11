<?php

namespace Database\Seeders;

use App\Models\Enums\OrderDeliveryTypeEnum;
use App\Models\Enums\OrderPackingTypeEnum;
use App\Models\Enums\OrderStateEnum;
use App\Models\MealPlan;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run()
    {
        $meal_plans = MealPlan::all() ;
        $product = Product::query()->firstOrFail() ;
        $user = User::query()->firstOrFail() ;
        foreach ($meal_plans as $meal_plan) {
            $model = Order::query()->updateOrCreate(
                [
                    "meal_plan_id" => $meal_plan["id"] ,
                ],
                [
                    "user_id" => $user["id"] ,
                    "meal_quantity" => random_int(1,20) ,
                    "total_amount" => random_int(100000,200000) ,
                    "delivery_type" => OrderDeliveryTypeEnum::InPerson ,
                    "packing_type" => OrderPackingTypeEnum::PlasticContainer ,
                    "state" => OrderStateEnum::Pending ,
                    "comment" => Str::random(40)
                ]
            ) ;
            $model->products_embed()->save(new OrderProduct([
                "product_id" => $product["id"] ,
                "quantity" => random_int(1,10) ,
                "total_price" => random_int(30000,40000) ,
            ])) ;
        }
    }
}
