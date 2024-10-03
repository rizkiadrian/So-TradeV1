<?php

namespace App\Exceptions;


use Exception;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

use App\Http\Responses\ApiResponse;

class CustomValidationException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request, Exception $exception)
    {
        if ($exception instanceof ValidationException) {
            $construct_error = [
                "message" => $exception->getMessage(),
                "errors" => $exception->errors()
            ];
            return ApiResponse::fail($construct_error, 422, "Invalid request");
        }
        return ApiResponse::fail(null, 422, "Invalid request");
    }
}
