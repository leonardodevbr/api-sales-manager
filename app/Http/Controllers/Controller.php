<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function prepareResponse($data = [], $message = null, $statusCode = 200): JsonResponse
    {
        $body = [
            "statusCode" => $statusCode,
            "data" => $data,
            "message" => $message
        ];
        return response()->json($body, $statusCode);
    }
}
