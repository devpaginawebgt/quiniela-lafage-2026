<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    protected function successResponse($data = [], int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'ok',
            'data' => $data,
        ], $code);
    }

    protected function errorResponse(string $message = 'Error interno del servidor.', int $code = 500, array $errors = []): JsonResponse
    {
        $response = [
            'status' => 'error',
            'message' => $message,
            'errors' => $errors
        ];

        return response()->json($response, $code);
    }
}
