<?php

/**
 * Application Constants
 */

return [
    // API status codes
    'status_code' => [
        'SUCCESS' => 1,
        'FAIL' => 0,
    ],

    // User roles
    'ROLES' => [
        'ADMIN' => 1,
        'CUSTOMER' => 2,
    ],

    'encryption_key' => env('APP_KEY'),
];
