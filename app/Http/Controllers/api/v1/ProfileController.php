<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Responses\ApiResponse;

class ProfileController extends Controller
{
    public function index()
    {
        $test = [
            "key" => "value"
        ];
        return ApiResponse::success($test);
    }
}
