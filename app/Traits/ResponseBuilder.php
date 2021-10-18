<?php

namespace App\Traits;

/**
 *
 */
trait ResponseBuilder
{
    public function responseCore($message, $data = null, $statusCode, $isSuccess = true, $errorBody = null)
    {
        if (! $message) {
            return response()->json(['message' => 'Message is required'], 500);
        }

        $response = [
            'success' => false,
            'code' => $statusCode,
            'message' => $message,
            'data' => [],
            'error' => [],
        ];

        if ($isSuccess) {
            $response['success'] = true;
            $response['data'] = $data;
        } else {
            $response['error'] = $errorBody;
        }

        return response()->json($response, $statusCode);
    }

    public function success($message, $data, $statusCode = 200)
    {
        return $this->responseCore($message, $data, $statusCode);
    }

    public function error($message, $statusCode = 500, $errorBody)
    {
        return $this->responseCore($message, null, $statusCode, false, $errorBody);
    }
}
