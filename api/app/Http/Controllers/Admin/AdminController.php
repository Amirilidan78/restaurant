<?php

namespace App\Http\Controllers\Admin;

use App\Extensions\SearchTable;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\Admin\UpdateAdminRequest;
use App\Http\Resources\NotSecure\AdminResource;
use App\Models\Admin;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class AdminController extends BaseController
{
    public function index() : AnonymousResourceCollection
    {
        return AdminResource::collection( SearchTable::handle_search( Admin::query() ) ) ;
    }

    public function show(Admin $admin) : AdminResource
    {
        return new AdminResource($admin) ;
    }

    public function store(StoreAdminRequest $request) : Response
    {
        $data = $request->validated() ;

        Admin::query()->create($data) ;

        return $this->response->ok() ;
    }

    public function update(Admin $admin, UpdateAdminRequest $request) : Response
    {
        $data = $request->validated() ;

        $admin->update($data) ;

        return $this->response->ok() ;
    }

    public function delete(Admin $admin) : Response
    {
        $admin->delete() ;

        return $this->response->ok() ;
    }

}
