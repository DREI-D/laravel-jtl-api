<?php

use DREID\LaravelJtlApi\Enums\Permission;

return [
    'base_url'          => env('JTL_API_BASE_URL'),
    'api_key'           => env('JTL_API_KEY'),

    // Headers
    'app_id'            => env('JTL_API_APP_ID', 'ApiApp/v0.0.1'),
    'challenge_code'    => env('JTL_API_CHALLENGE_CODE', 'ApiApp'),
    'run_as'            => env('JTL_API_RUN_AS', 'ApiApp/v0.0.1'),
    'version'           => env('JTL_API_VERSION', '0.0.1'),

    // Registration
    'display_name'      => 'Api App',
    'description'       => 'My Api App',
    'provider_name'     => 'Api App Provider',
    'provider_website'  => 'dreid.de',
    'app_icon'          => resource_path('vendor/drei-d/laravel-jtl-api/assets/app-icon.png'),
    'registration_type' => 0,

    'permissions' => [
        Permission::AllRead,
        Permission::StockAdjustment,
        Permission::CreateSalesOrder,
        Permission::CreateSalesOrderLineItem,
        Permission::CreateCustomer,
    ]
];
