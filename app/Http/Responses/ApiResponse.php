<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class ApiResponse {
    public static function success($data = null, $message = 'Data fetched successfully', $statusCode = 200) {
        $apiResponse = [
            "meta" => [
                "message" => $message,
                "status" => 'OK',
                "code" => $statusCode
            ],
            "data" => [
                "result" => $data
            ]
        ];
        return response()->json($apiResponse, $statusCode);
    }

    public static function fail($error = null, $message = 'An Error occured', $statusCode = 400) {
        $apiResponse = [
            "meta" => [
                "message" => $message,
                "status" => 'Fail',
                "code" => $statusCode
            ],
            "error" => [
                "result" => $error
            ]
        ];
        return response()->json($apiResponse, $statusCode);
    }
}