<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Enums\AdminRoleEnum;
use App\Models\Enums\AdminStateEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run()
    {
        $admins = [
            [
                [
                    "username" => "ilidan",
                ],
                [
                    "first_name" => "امیر حسین",
                    "last_name" => "رنجبر حسنی",
                    "phone" => "+989370843199",
                    "email" => "amirilidan78@gmail.com",
                    "password" => bcrypt("Amir.23334152"),
                    "avatar" => null,
                    "state" => AdminStateEnum::ACTIVE,
                    "role" => AdminRoleEnum::SuperAdmin,
                ],
            ],
        ] ;

        foreach ( $admins as $admin ) {
            Admin::query()->updateOrCreate(...$admin) ;
        }
    }
}
