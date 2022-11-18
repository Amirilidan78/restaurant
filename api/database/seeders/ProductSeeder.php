<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run()
    {
        $products = [
            [
                [
                    "name" => "نوشابه",
                ],
                [
                    "description" => "نوشابه (به انگلیسی: Soft drink) نوعی نوشیدنی شامل آب گازدار، مواد شیرین‌کننده و اسانس است. نوشابه در لغت به معنای هر چیز نوشیدنی می‌باشد.",
                    "images" => [],
                    "price" => 5000,
                ],
            ],
            [
                [
                    "name" => "ماست",
                ],
                [
                    "description" => "ماست، یکی از فراورده‌های شیر است که با تخمیر توسط باکتری‌ها تولید می‌شود و بهتر است با غذا خورده شود. در این فرایند، لاکتوز موجود در شیر به اسید لاکتیک تبدیل می‌شود. ماست اغلب از شیر گاو، گاومیش، گوسفند، بز و سایر حیوانات اهلی تولید می‌گردد.",
                    "images" => [],
                    "price" => 2500,
                ],
            ],
            [
                [
                    "name" => "نوشابه",
                ],
                [
                    "description" => "نوشابه (به انگلیسی: Soft drink) نوعی نوشیدنی شامل آب گازدار، مواد شیرین‌کننده و اسانس است. نوشابه در لغت به معنای هر چیز نوشیدنی می‌باشد.",
                    "images" => [],
                    "price" => 5000,
                ],
            ],
            [
                [
                    "name" => "ترشی",
                ],
                [
                    "description" => "ترشی یکی از مخلفات خوشمزه و دلخواه برای انواع غذاهای ما ایرانیان است، که انواع مختلفی دارد و قومیتهای مختلف بنا به ذائقه و موادی که در دسترسشان بوده و اصولا برای نگهداری از مواد غذایی و استفاده از آنها در غیر فصل رویش اقدام به تهیه ی ترشی می کرده اند. البته همه ی اقوام و ملیتهای مختلف در سراسر جهان ترشی های مخصوص خودشان را دارند. ما برایتان یک نمونه از ترشی مخلوط را شرح دادیم.",
                    "images" => [],
                    "price" => 60000,
                    "has_stock" => true,
                    "stock" => 60,
                ],
            ],
            [
                [
                    "name" => "کالباس مرغ",
                ],
                [
                    "description" => "کالباس یکی از محبوب ترین مواد غذایی است که طرفداران بسیار زیادی دارد. البته خیلی افراد به دلیل اینکه از طریقه تهیه آن مطمئن نیستند سعی می کنند کمتر سوسیس و کالباس مصرف کنند. با تهیه کالباس خانگی سالم با گوشت مرغ می توانید با اطمینان از این ماده غذایی استفاده کنید.",
                    "images" => [],
                    "price" => 50000,
                    "can_preorder" => true ,
                    "preorder_delay_day" => 7,
                    "preorder_min_amount" => 20,
                ],
            ],
            [
                [
                    "name" => "کالباس گوشت",
                ],
                [
                    "description" => "کالباس گوشت خانگی درست کنید تا سلامت خود وخانواده تان با خوردن فست فود به خطر نیندازید. در این بخش قصد داریم شما خانم های عزیز را با آموزش تصویری طرز تهیه کالباس گوشت خانگی مرحله به مرحله آشنا کنیم که اگر شما می خواهید در منزل یک کالباس گوشت خانگی خوشمزه درست کنید با ما همراه باشید تا طرز تهیه کالباس گوشت خانگی تصویری را به شما آموزش دهیم. شما عزیزان می توانید کالباس گوشت خانگی را در منزل درست کرده و از مضرات کالباس های کارخانه ای دور بمانید و بدون نگرانی از مواد نگه دارنده از طعم خوب کالباس گوشت خانگی لذت ببرید.",
                    "images" => [],
                    "price" => 50000,
                    "can_preorder" => true ,
                    "preorder_delay_day" => 7,
                    "preorder_min_amount" => 20,
                ],
            ],
        ] ;

        foreach ( $products as $product ) {
            Product::query()->updateOrCreate(...$product) ;
        }
    }
}
