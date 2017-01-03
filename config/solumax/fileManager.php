<?php

return [
    
    'aws' => [
        'region' => env('AWS_REGION'),
        'bucket' => env('AWS_S3_BUCKET'),
        'key' => env('AWS_KEY'),
        'secret' => env('AWS_SECRET'),
    ],
    
    'storage_type' => 'S3'
];
