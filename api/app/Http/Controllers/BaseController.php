<?php

namespace App\Http\Controllers;

use App\Services\Response\ResponseService;

class BaseController extends Controller
{
    public function __construct(public ResponseService $response)
    {}

}
