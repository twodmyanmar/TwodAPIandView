<?php

namespace App\Traits;

trait ApiResponser
{
    protected function successResponse($data = null, $message = 'Success', $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' =>   $data
        ], $code);
    }

    protected function errorResponse($message = null, $code = 400)
    {
        return response()->json([
            'status'=> 'error',
            'message' => $message,
        ], $code);
    }
}
