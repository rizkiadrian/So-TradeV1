<?php

namespace App\Exceptions;


use Exception;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

use App\Http\Responses\ApiResponse;

class GlobalException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request, Exception $exception)
    {
        if ($exception instanceof Exception) {
            $construct_error = [
                "message" => $exception->getMessage(),
                "errors" => $exception
            ];
            return ApiResponse::fail($construct_error, 500, "Internal Server Error");
        }
        return ApiResponse::fail(null, 422, "Internal Server Error");
    }
}
