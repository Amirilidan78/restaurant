<?php

namespace App\Http\Controllers\Admin;

use App\Extensions\SearchTable;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Http\Resources\NotSecure\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserController extends BaseController
{

    public function index() : AnonymousResourceCollection
    {
        return UserResource::collection( SearchTable::handle_search( User::query() ) ) ;
    }

    public function show(User $user) : UserResource
    {
        return new UserResource($user) ;
    }

    public function update(User $user, UpdateUserRequest $request) : Response
    {
        $data = $request->validated() ;

        $user->update($data) ;

        return $this->response->ok() ;
    }

    public function delete(User $user) : Response
    {
        $user->delete() ;

        return $this->response->ok() ;
    }
}
