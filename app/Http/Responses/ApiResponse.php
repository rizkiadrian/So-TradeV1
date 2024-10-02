<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class ApiResponse {
    /**
     * Returns a successful response with a message
     *
     * @param null $data
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
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


    /**
     * Returns a failed response with a message
     *
     * @param null $error
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
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