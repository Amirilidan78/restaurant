<?php

namespace App\Http\Controllers\Admin;

use App\Extensions\SearchTable;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Http\Resources\NotSecure\ProductResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProductController extends BaseController
{

    public function all() : AnonymousResourceCollection
    {
        return ProductResource::collection( Product::all() ) ;
    }

    public function index() : AnonymousResourceCollection
    {
        return ProductResource::collection( SearchTable::handle_search( Product::query() ) ) ;
    }

    public function show(Product $product) : ProductResource
    {
        return new ProductResource($product) ;
    }

    public function store(StoreProductRequest $request) : Response
    {
        $data = $request->validated() ;

        Product::query()->create($data) ;

        return $this->response->ok() ;
    }

    public function update(Product $product, UpdateProductRequest $request) : Response
    {
        $data = $request->validated() ;

        $product->update($data) ;

        return $this->response->ok() ;
    }

    public function delete(Product $product) : Response
    {
        $product->delete() ;

        return $this->response->ok() ;
    }
}
