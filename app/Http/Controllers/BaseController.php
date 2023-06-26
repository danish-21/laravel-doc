<?php

namespace App\Http\Controllers;

class BaseController
{
    // In a helper function or utility class
    function standardResponse($message, $data,$type,  $httpCode)
    {
        return response()->json([
            "message" => $message,
            "data" => $data,
            "type" => $type
        ], $httpCode);
    }


}
