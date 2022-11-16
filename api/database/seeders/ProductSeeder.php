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
                    "stock" => 20,
                    "pre_order_delay_hour" => 24,
                    "pre_order_min_amount" => 10,
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
                    "stock" => 30,
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
                    "stock" => 60,
                ],
            ],
            [
                [
                    "name" => "نان تافتون",
                ],
                [
                    "description" => "نان تافتون یکی از انواع نان های خوشمزه و پر طرفدار ایرانی است که از نظر ظاهری شباهت زیادی به نان لواش دارد",
                    "images" => [],
                    "price" => 2500,
                    "stock" => 40,
                ],
            ],
        ] ;

        foreach ( $products as $product ) {
            Product::query()->updateOrCreate(...$product) ;
        }
    }
}
