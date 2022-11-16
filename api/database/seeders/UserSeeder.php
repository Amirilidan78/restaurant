<?php

namespace Database\Seeders;

use App\Models\Enums\UserGenderEnum;
use App\Models\Enums\UserStateEnum;
use App\Models\User;
use App\Services\Date\DateService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run()
    {
        $users = [
            [
                [
                    "phone" => "+989370843199",
                ],
                [
                    "first_name" => "amir",
                    "last_name" => "ranjbar",
                    "email" => "amirilidan78@gmail.com",
                    "gender" => UserGenderEnum::MALE,
                    "password" => bcrypt("Amir.23334152"),
                    "birth_date" => DateService::CarbonToDate(now()) ,
                    "address" => "کرمان رفسنجان آفتاب 12",
                    "mobile" => "03434242554",
                    "avatar" => null,
                    "state" => UserStateEnum::ACTIVE,
                ],
            ],
        ] ;

        foreach ( $users as $user ) {
            User::query()->updateOrCreate(...$user) ;
        }
    }
}
