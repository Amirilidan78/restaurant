<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Requests\User\Auth\LoginRequest;
use App\Http\Requests\User\Auth\RegisterRequest;
use App\Models\User;
use App\Services\Auth\AuthService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    public function login(LoginRequest $request) : Response
    {
        $data = $request->validated() ;

        $valid = AuthService::ValidateUser($data["phone"],$data["password"]) ;
        if( !$valid ) {
            return $this->response->error("Authentication failed!");
        }


        $user = User::query()->where("phone",$data["phone"])->first() ;
        if( !$user ) {
            return $this->response->error("Authentication failed!");
        }

        return $this->response->ok([
            "token" => AuthService::GenerateToken($user)
        ]) ;
    }

    public function register(RegisterRequest $request) : Response
    {
        $data = $request->validated() ;

        $user = User::query()->where("phone",$data["phone"])->first() ;
        if( $user ) {
            return $this->response->error("Duplicated phone number!");
        }

        $user = User::query()->create([
            "name" => $data["name"] ,
            "phone" => $data["phone"] ,
            "password" => Hash::make($data["pass"]) ,
        ]) ;

        /// TODO : send phone code

        return $this->response->ok([
            "id" => $user["id"] ,
        ]) ;
    }

    public function user() : Response
    {
        $user = AuthService::User() ;
        if ( !$user ) {
            return $this->response->error("Authentication failed!");
        }

        return $this->response->ok($user->toArray()) ;
    }

}
