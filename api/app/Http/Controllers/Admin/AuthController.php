<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\Auth\ForgotPasswordRequest;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Http\Requests\Admin\Auth\ResetPasswordRequest;
use App\Http\Requests\Admin\Auth\ValidateForgotPasswordRequest;
use App\Models\Admin;
use App\Models\Enums\RequestTypeEnum;
use App\Models\Request;
use App\Services\Auth\AuthModel;
use App\Services\Auth\AuthService;
use App\Services\Auth\AuthTypeEnum;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class AuthController extends BaseController
{
    public function login(LoginRequest $request) : Response
    {
        $data = $request->validated() ;

        $valid = AuthService::ValidateAdminPassword($data["username"],$data["password"]) ;
        if( !$valid ) {
            return $this->response->error("رمز عبور یا نام کاربری اشتباه است");
        }

        $admin = Admin::query()->where("username",$data["username"])->first() ;
        if( !$admin ) {
            return $this->response->error("رمز عبور یا نام کاربری اشتباه است");
        }

        $model = new AuthModel(
            AuthTypeEnum::Admin ,
            $admin["first_name"] ,
            $admin["last_name"] ,
            $admin["username"] ,
            $admin["email"] ,
            $admin["phone"] ,
        ) ;

        return $this->response->ok([
            "token" => AuthService::GenerateToken($admin) ,
            "model" => $model->toArray()
        ]) ;
    }

    public function forgot_password(ForgotPasswordRequest $request) : Response
    {
        $data = $request->validated() ;

        $admin = Admin::query()->where("username",$data["username"])->first() ;
        if( !$admin ) {
            return $this->response->error("حساب کاربری یافت نشد");
        }

        $request = Request::query()->create([
            "type" => RequestTypeEnum::AdminForgotPassword ,
            "username" => $admin["username"] ,
            "token" => Str::random(20) ,
        ]) ;

        /// TODO : send sms => $request["token"]

        return $this->response->ok() ;
    }

    public function validate_forgot_password(ValidateForgotPasswordRequest $request) : Response
    {
        $data = $request->validated() ;

        $request = Request::query()->where("token",$data["token"])->where("type",RequestTypeEnum::AdminForgotPassword->value)->first() ;
        if( !$request ) {
            return $this->response->error("لینک فراموشی رمز عبور نامعتبر یا منقضی شده است");
        }

        return $this->response->ok() ;
    }

    public function reset_password(ResetPasswordRequest $request) : Response
    {
        $data = $request->validated() ;

        $request = Request::query()->where("token",$data["token"])->where("type",RequestTypeEnum::AdminForgotPassword->value)->first() ;
        if( !$request ) {
            return $this->response->error("لینک فراموشی رمز عبور نامعتبر یا منقضی شده است");
        }

        $admin = Admin::query()->where("username",$request["username"])->first() ;
        if( !$admin ) {
            return $this->response->error("حساب کاربری یافت نشد");
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
            return $this->response->error("لطفا دوباره وارد حساب کاربری خود شوید");
        }

        return $this->response->ok($model->toArray()) ;
    }

}
