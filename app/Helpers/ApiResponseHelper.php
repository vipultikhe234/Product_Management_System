<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Helper class for API responses
 */
class ApiResponseHelper
{
    /**
     * Success response
     */
    public static function success(string $message = "Success", $key = 'data', $data = null, int $httpStatusCode = 200): JsonResponse
    {
        $response = [
            "status" => config('constants.status_code.SUCCESS'),
            "message" => $message,
        ];

        if ($data !== null) {
            if ($key) {
                $response[$key] = $data;
            } else {
                $response = array_merge($response, (array)$data);
            }
        }

        return response()->json($response, $httpStatusCode);
    }

    /**
     * Error response
     */
    public static function error(string $message = "Error", int $httpStatusCode = 500, $data = null): JsonResponse
    {
        $response = [
            "status" => config('constants.status_code.FAIL'),
            "message" => $message,
        ];

        if ($data !== null) {
            $response = array_merge($response, (array)$data);
        }

        return response()->json($response, $httpStatusCode);
    }

    /**
     * Validation error response
     */
    public static function validationError($validator)
    {
        $errorMessages = collect($validator->errors()->all())->join("\n");
        
        return response()->json([
            'status' => config('constants.status_code.FAIL'),
            'message' => $errorMessages
        ], 200);
    }

    /**
     * Server error response
     */
    public static function internalServerError($errorMessages = null)
    {
        return response()->json([
            'status' => config('constants.status_code.FAIL'),
            'message' => __('message.INTERNAL_SERVER_ERROR') ?? 'Internal Server Error',
            'error_message' => $errorMessages
        ], 500);
    }
}
