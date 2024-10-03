<?php

namespace App\Exceptions;


use Exception;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

use App\Http\Responses\ApiResponse;

class AuthenticationException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request, Exception $exception)
    {
        if ($exception instanceof Exception) {
            $construct_error = [
                "message" => "Unauthorized",
                "errors" => "Request not allowed"
            ];
            return ApiResponse::fail($construct_error, 401, "Unauthorized");
        }
        return ApiResponse::fail(null, 401, "Unauthorized");
    }
}
