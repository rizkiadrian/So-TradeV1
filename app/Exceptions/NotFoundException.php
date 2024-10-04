<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;

use App\Http\Responses\ApiResponse;

class NotFoundException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request, Exception $exception)
    {
        if ($exception instanceof NotFoundException) {
            $construct_error = [
                "message" => 'Path not found',
                "errors" => $exception
            ];
            return ApiResponse::fail($construct_error, 404, "Path not found");
        }
        return ApiResponse::fail(null, 404, "Path not found");
    }
    
}
