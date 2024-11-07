<?php

namespace App\Http\Controllers\api\EntertainmentHub;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\Request;

class PingController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function openConnection(Request $request)
    {
        // Simply return a success message to indicate that connection is established
        $data = [
            "connection_status" => true
        ];
        return ApiResponse::success($data);
    }
}
