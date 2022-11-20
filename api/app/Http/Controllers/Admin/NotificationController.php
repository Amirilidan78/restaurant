<?php

namespace App\Http\Controllers\Admin;

use App\Extensions\SearchTable;
use App\Http\Controllers\BaseController;
use App\Http\Resources\NotSecure\NotificationResource;
use App\Models\AdminNotification;
use App\Models\UserNotification;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NotificationController extends BaseController
{
    public function admin_index() : AnonymousResourceCollection
    {
        return NotificationResource::collection( SearchTable::handle_search( AdminNotification::query() ) ) ;
    }

    public function user_index() : AnonymousResourceCollection
    {
        return NotificationResource::collection( SearchTable::handle_search( UserNotification::query() ) ) ;
    }

}
