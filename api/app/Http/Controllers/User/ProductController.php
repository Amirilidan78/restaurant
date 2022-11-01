<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Models\Product;
use Illuminate\Http\Response;

class ProductController extends BaseController
{
    public function index() : Response
    {
        return $this->response->ok([
            "products" => Product::query()->paginate(15)
        ]) ;
    }

}
