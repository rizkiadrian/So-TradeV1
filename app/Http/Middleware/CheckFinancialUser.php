<?php

namespace App\Http\Middleware;

use App\Enums\TokenAbility;
use App\Http\Responses\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckFinancialUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user has the "financial-user" ability
        if ($request->user() && $request->user()->tokenCan(TokenAbility::FINANCIAL_USER->value)) {
            return $next($request);
        }

        // If not, return an unauthorized response
        $construct_error = [
            "message" => "Forbidden",
            "errors" => "Request not allowed"
        ];
        return ApiResponse::fail($construct_error, 403, "Forbidden");
    }
}
