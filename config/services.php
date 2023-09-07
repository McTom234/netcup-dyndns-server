<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'netcup-ccp' => [
        'customer_number' => env('NC_CUSTOMER_NUMBER'),
        'api_key' => env('NC_API_KEY'),
        'api_password' => env('NC_API_PASSWORD'),
        'api_endpoint' => env('NC_API_ENDPOINT', 'https://ccp.netcup.net/run/webservice/servers/endpoint.php?JSON'),
    ],

];
