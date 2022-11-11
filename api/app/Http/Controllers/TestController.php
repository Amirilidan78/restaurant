<?php

namespace App\Http\Controllers;

use App\Models\Enums\UserStateEnum;
use App\Models\User;
use App\Services\Auth\AuthService;

class TestController extends Controller
{
    public function __invoke()
    {
        $user = User::query()->create([
            "state" => UserStateEnum::PENDING ,
        ]) ;

        return $user ;
    }
}
