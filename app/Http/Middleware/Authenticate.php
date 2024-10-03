<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Responses\ApiResponse;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If the user is not authenticated, return an unauthorized response
        if (!$request->user()) {
            return ApiResponse::fail(['message' => 'Unauthorized'], null, 401);
        }

        // Otherwise, continue with the request
        return $next($request);
    }
}
