<?php

namespace App\Providers;

class BuildHttpResponse
{
    public static function formatResponse($msg, $statusCode, $result, $data = '')
    {
        $arrayReturn = [
            'message' => $msg,
            'data' => $data,
            'statusCode' => $statusCode,
            'result' => $result,
        ];
        return response()->json($arrayReturn, $statusCode);
    }
}
