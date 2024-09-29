<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
