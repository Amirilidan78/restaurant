<?php

namespace App\Services\Auth;

use App\Models\Admin;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    const alg = "HS256" ;
    const header_key = "Authorization" ;
    const key = "dIDQ7UzdL^kL0fOZNSGfW0AN1s6ETeW^" ;
    const api_expiration_hour = 6 ;

    public static function ValidateAdminPassword(string $username, string $password) : bool
    {
        $admin = Admin::query()->where("username",$username)->first() ;

        if ( !$admin ) {
            return false ;
        }

        return Hash::check($admin["password"], $password) ;
    }

    public static function ValidateUserPassword(string $phone, string $password) : bool
    {
        $user = User::query()->where("phone",$phone)->first() ;

        if ( !$user ) {
            return false ;
        }

        return Hash::check($user["password"], $password) ;
    }

    public static function GenerateToken(User|Admin $model) : string
    {
        $payload = [
            "auth" => ( new AuthModel(
                $model instanceof Admin ? AuthTypeEnum::Admin : AuthTypeEnum::User ,
                    $model["first_name"] ,
                    $model["last_name"] ,
                    $model["username"] ,
                    $model["email"] ,
                    $model["phone"] ,
                    $model["token"] ,
            ))->toArray() ,
            "valid_until" => now()->addHours(self::api_expiration_hour)->timestamp
        ];

        return JWT::encode($payload, self::key , self::alg);
    }

    public static function DecodeToken(string $token) : AuthModel|null
    {
        $arr = (array) JWT::decode($token, new Key(self::key, self::alg)) ;

        if ( intval($arr["valid_until"]) < now()->timestamp ) {
            return null ;
        }

        return new AuthModel(...$arr["auth"]) ;
    }

    public static function GetAuthenticatedEntity() : AuthModel|null
    {
        $token = request()->header(self::header_key) ;

        if ( !$token ) {
            return null ;
        }

        return self::DecodeToken($token) ;
    }

}
