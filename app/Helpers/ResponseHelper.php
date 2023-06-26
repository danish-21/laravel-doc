<?php

namespace App\Helpers;

class ResponseHelper
{
    public static function paginationResponse($items)
    {
        $pagination = [
            'page' => $items->currentPage(),
            'total' => $items->total(),
            'pages' => $items->lastPage(),
            'perPage' => $items->perPage(),
        ];


        return [
            'message' => 'Data retrieved successfully',
            'data' => [
                'items' => $items->items(),
                'pagination' => $pagination,
            ],
            'type'=> null,
        ];
    }

    public static function createOrUpdateResponse($data,$type = null, $httpCode= 200)
    {
        return response()->json([
            "message" => 'Resource Create/Update successfully',
            "data" => $data,
            "type" => $type
        ], $httpCode);
    }
    public static function deleteResponse($data,$type = null, $httpCode= 200)
    {
        return response()->json([
            "message" => 'Resource Deleted successfully',
            "data" => $data,
            "type" => $type
        ], $httpCode);
    }
}
