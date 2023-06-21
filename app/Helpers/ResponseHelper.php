<?php

namespace App\Helpers;

class ResponseHelper
{
    public static function paginationResponse($items, $pagination)
    {
        return [
            'message' => 'Data retrieved successfully',
            'data' => [
                'items' => $items,
                'pagination' => $pagination,
            ],
            'type'=> null,
        ];
    }

}
