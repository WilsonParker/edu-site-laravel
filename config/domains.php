<?php

// $rootDomain = env('ROOT_DOMAIN', 'study-laravel-project.co.kr');
$rootDomain = env('APP_URL', 'study-laravel-project.co.kr');

return [
    'root_domain' => $rootDomain,
    'domain' => [
        'api' => env('API_SUB_DOMAIN', 'api') . '.' . $rootDomain,
        'admin' => env('ADMIN_SUB_DOMAIN', 'admin') . '.' . $rootDomain,
        'mobile' => env('MOBILE_SUB_DOMAIN', 'mobile') . '.' . $rootDomain,
        'test' => env('TEST_SUB_DOMAIN', 'test') . '.' . $rootDomain,
    ],
];
