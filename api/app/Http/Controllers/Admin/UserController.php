<?php

namespace App\Http\Controllers\Admin;

use App\Extensions\SearchTable;
use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\NotSecure\UserResource;

class UserController extends BaseController
{

    public function index() : AnonymousResourceCollection
    {
        return UserResource::collection( SearchTable::handle_search( User::query()->select("id","first_name","last_name","phone","email","created_at") ) ) ;
    }
}
