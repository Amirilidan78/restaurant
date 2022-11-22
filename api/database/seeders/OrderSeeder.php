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
        foreach ( range(0,10) as $_ )
            $this->createMealOrder($meal,$products,$user) ;

        // -------------- order type store -------------- //
        foreach ( range(0,10) as $_ )
            $this->createMealStore($products,$user) ;

        // -------------- order Preorder store -------------- //
        foreach ( range(0,10) as $_ )
            $this->createMealPreorder($products,$user) ;


    }


    private function createMealOrder(Meal $meal,$products,User $user)
    {
        $model = Order::query()->updateOrCreate(
            [
                "type" => OrderTypeEnum::Meal ,
                "total_price" => rand(100000,300000) ,
            ],
            [
                "user_id" => $user["id"] ,
                "delivery_type" => OrderDeliveryTypeEnum::InPerson ,
                "packing_type" => OrderPackingTypeEnum::PlasticContainer ,
                "state" => OrderStateEnum::Payed ,
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
    }

    private function createMealStore($products,User $user)
    {
        $model = Order::query()->updateOrCreate(
            [
                "type" => OrderTypeEnum::Store ,
                "total_price" => rand(100000,300000) ,
            ],
            [
                "user_id" => $user["id"] ,
                "delivery_type" => OrderDeliveryTypeEnum::InPerson ,
                "packing_type" => OrderPackingTypeEnum::PlasticContainer ,
                "state" => OrderStateEnum::Payed ,
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
    }

    private function createMealPreorder($products,User $user)
    {
        $model = Order::query()->updateOrCreate(
            [
                "type" => OrderTypeEnum::Preorder ,
                "total_price" => rand(100000,300000) ,
            ],
            [
                "user_id" => $user["id"] ,
                "delivery_type" => OrderDeliveryTypeEnum::InPerson ,
                "packing_type" => OrderPackingTypeEnum::PlasticContainer ,
                "state" => OrderStateEnum::Payed ,
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
