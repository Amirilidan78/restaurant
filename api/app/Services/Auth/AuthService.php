<?php

namespace App\Services\Auth;

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

    public static function ValidateUser(string $phone, string $password) : bool
    {
        $user = User::query()->where("phone",$phone)->first() ;

        if ( !$user ) {
            return false ;
        }

        return Hash::check($user["password"], $password) ;
    }

    public static function GenerateToken(User $user) : string
    {
        $payload = [
            ...$user->toArray() ,
            "valid_until" => now()->addHours(self::api_expiration_hour)->timestamp
        ];

        return JWT::encode($payload, self::key , self::alg);
    }

    public static function DecodeToken(string $token) : User|null
    {
        $arr = (array) JWT::decode($token, new Key(self::key, self::alg)) ;

        if ( intval($arr["valid_until"]) < now()->timestamp ) {
            return null ;
        }

        unset($arr["valid_until"]) ;

        return new User($arr) ;
    }

    public static function User() : User|null
    {
        $token = request()->header(self::header_key) ;

        if ( !$token ) {
            return null ;
        }

        return self::DecodeToken($token) ;
    }

}
