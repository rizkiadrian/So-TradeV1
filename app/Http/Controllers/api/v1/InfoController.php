<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responses\ApiResponse;

class InfoController extends Controller
{
    /**
     * Check API connection
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show() {
        $timestamp = now();
        $data = [
            "message" => "Connection success",
            "timestamp" => $timestamp
        ];
        return response()->json($data, 200);
    }

    /**
     * Return a successful response with a message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function testSuccessResponse() {
        $dataToReturn = [
            "message" => "Hello SoTradeV1"
        ];
        return ApiResponse::success($dataToReturn);
    }

    /**
     * Return a failed response with a message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function testFailResponse() {
        $errorToReturn = [
            "message" => "Alert SoTradeV1"
        ];
        return ApiResponse::fail($errorToReturn);
    }

    /**
     * Check protected route
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function testProtectedRoute(Request $request) {
        $dataToReturn = $request->user();
        return ApiResponse::success($dataToReturn);
    }
    
}
