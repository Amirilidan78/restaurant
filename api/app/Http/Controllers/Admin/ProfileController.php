<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\Profile\UpdatePasswordRequest;
use App\Http\Requests\Admin\Profile\UpdateProfileRequest;
use App\Http\Resources\NotSecure\AdminResource;
use App\Models\Admin;
use App\Services\Auth\AuthService;
use Illuminate\Http\Response;

class ProfileController extends BaseController
{
    public function get_avatar() : Response
    {
        $model = AuthService::GetAuthenticatedEntity() ;

        $admin = Admin::query()->where("username",$model->username)->first();
        if( !$admin ) {
            return $this->response->error("Admin not found!");
        }

        return $this->response->ok([
            "avatar" => $admin["avatar"]
        ]) ;
    }

    public function get_profile() : Response|AdminResource
    {
        $model = AuthService::GetAuthenticatedEntity() ;

        $admin = Admin::query()->where("username",$model->username)->first();
        if( !$admin ) {
            return $this->response->error("Admin not found!");
        }

        return new AdminResource($admin) ;
    }

    public function update_profile(UpdateProfileRequest $request) : Response
    {
        $data = $request->validated() ;

        $model = AuthService::GetAuthenticatedEntity() ;

        Admin::query()->where("username",$model->username)->update($data) ;

        return $this->response->ok() ;
    }

    public function update_password(UpdatePasswordRequest $request) : Response
    {
        $data = $request->validated() ;

        $model = AuthService::GetAuthenticatedEntity() ;

        Admin::query()->where("username",$model->username)->update([
            "password" => bcrypt($data["password"])
        ]) ;

        return $this->response->ok() ;
    }

}
