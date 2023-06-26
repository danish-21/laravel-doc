<?php

use App\Models\File;

return [
    'is_local' => true,
    'types' => [
        File::TYPE_PRODUCT_IMAGE => [
            'type' => File::TYPE_PRODUCT_IMAGE,
            'local_path' => 'images/products',
            'validation' => 'required',
            'valid_file_types' => ['jpg', 'png', 'jpeg'],
        ],
        File::TYPE_PRODUCT_CATEGORY => [
            'type' => File::TYPE_PRODUCT_CATEGORY,
            'local_path' => 'images/categories',
            'validation' => 'required',
            'valid_file_types' => ['jpg', 'png', 'jpeg'],
        ],
    ]
];
