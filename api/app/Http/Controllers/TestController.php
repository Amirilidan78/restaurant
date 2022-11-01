<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Auth\AuthService;

class TestController extends Controller
{
    public function __invoke()
    {
        $token = AuthService::GenerateToken(new User([
            "name" => "amir" ,
            "phone" => "09370843199" ,
            "password" => encrypt("amir_pass")
        ]));

        return AuthService::DecodeToken($token) ;
    }
}
