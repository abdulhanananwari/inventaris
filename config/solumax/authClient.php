<?php


return [

    'module_id' => env('MODULE_ID'),

    'api_auth' => [
        'client_key' => env('AUTH_CLIENT_KEY', null),
        'client_secret' => env('AUTH_CLIENT_SECRET', null),
    ],

    'url' => [

        'auth' => env('ACCOUNT_SERVER_DOMAIN') . 'api/auth/server/',

        'module_role' => env('ACCOUNT_SERVER_DOMAIN') . 'api/resources/auth-client/module-role/',
        'module' => env('ACCOUNT_SERVER_DOMAIN') . 'api/resources/auth-client/module/',
        'tumr' => env('ACCOUNT_SERVER_DOMAIN') . 'api/resources/auth-client/tumr/',

        'user' => env('ACCOUNT_SERVER_DOMAIN') . 'api/resources/auth-client/user/',
        
        'tenant' => env('ACCOUNT_SERVER_DOMAIN') . 'api/resources/auth-client/tenant/',
    ]
];