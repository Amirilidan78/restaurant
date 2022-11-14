<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\Auth\ForgotPasswordRequest;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Http\Requests\Admin\Auth\ResetPasswordRequest;
use App\Models\Admin;
use App\Models\Enums\RequestTypeEnum;
use App\Models\Request;
use App\Services\Auth\AuthService;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class AuthController extends BaseController
{
    public function login(LoginRequest $request) : Response
    {
        $data = $request->validated() ;

        $valid = AuthService::ValidateAdminPassword($data["username"],$data["password"]) ;
        if( !$valid ) {
            return $this->response->error("Authentication failed!");
        }

        $admin = Admin::query()->where("username",$data["username"])->first() ;
        if( !$admin ) {
            return $this->response->error("Authentication failed!");
        }

        return $this->response->ok([
            "token" => AuthService::GenerateToken($admin)
        ]) ;
    }

    public function forgot_password(ForgotPasswordRequest $request) : Response
    {
        $data = $request->validated() ;

        $admin = Admin::query()->where("username",$data["username"])->first() ;
        if( !$admin ) {
            return $this->response->error("Admin not found!");
        }

        $request = Request::query()->create([
            "type" => RequestTypeEnum::AdminForgotPassword ,
            "username" => $admin["username"] ,
            "token" => Str::random(20) ,
        ]) ;

        /// TODO : send sms => $request["token"]

        return $this->response->ok() ;
    }

    public function reset_password(ResetPasswordRequest $request) : Response
    {
        $data = $request->validated() ;

        $admin = Admin::query()->where("username",$data["username"])->first() ;
        if( !$admin ) {
            return $this->response->error("Admin not found!");
        }

        $request = Request::query()->where("username",$data["username"])->where("token",$data["token"])->where("type",RequestTypeEnum::AdminForgotPassword->value)->first() ;
        if( !$request ) {
            return $this->response->error("Invalid request!");
        }

        $admin->update([
            "password" => bcrypt($data["password"])
        ]);

        $request->delete() ;

        return $this->response->ok() ;
    }

    public function user() : Response
    {
        $model = AuthService::GetAuthenticatedEntity() ;
        if ( !$model ) {
            return $this->response->error("Authentication failed!");
        }

        return $this->response->ok($model->toArray()) ;
    }

}
