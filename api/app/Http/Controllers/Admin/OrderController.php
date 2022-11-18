<?php

namespace App\Http\Controllers\Admin;

use App\Extensions\SearchTable;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\Order\UpdateOrderRequest;
use App\Http\Resources\NotSecure\OrderResource;
use App\Models\Order;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class OrderController extends BaseController
{
    public function index() : AnonymousResourceCollection
    {
        return OrderResource::collection( SearchTable::handle_search( Order::query()->with(["user","meal","product","products"]) ) ) ;
    }

    public function show(Order $order) : OrderResource
    {
        return new OrderResource($order) ;
    }

    public function update(Order $order, UpdateOrderRequest $request) : Response
    {
        $data = $request->validated() ;

        $order->update($data) ;

        return $this->response->ok() ;
    }

}
