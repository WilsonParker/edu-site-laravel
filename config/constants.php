<?php

return [
    'payment' => [
        'kakao' => [
            'key' => env('KAKAOPAY_ADMIN_KEY'),
            'autopay_tid' => env('KAKAOPAY_AUTOPAY_TID'),
            'tid' => env('KAKAOPAY_TID'),
        ],
        'iamport' => [
            'key' => env('IMP_KEY'),
            'api' => env('IMP_API_KEY'),
            'secret' => env('IMP_SECRET'),
        ],
    ],

    'image' => [
        'url' => env('IMAGES_URL'),
        "resize_url" => env('IMAGES_RESIZE_URL'),
        "images_crop_url" => env('IMAGES_CROP_URL'),
    ],

    'web' => [
        'title' => 'edu-site-laravel',
        'contact' => '00-000-0000',
    ],
];
