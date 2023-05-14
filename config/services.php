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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id' => '2408-a5j1qr5atm0r106sifd8b.apps.googleusercontent.com',
        'client_secret' => 'GOCSPX-AHO1MXCF18JRBHQ5pRlo3_',
        'redirect' => 'http://loclahost/login/google/callback',
    ],
    'facebook' => [
        'client_id' => '5277390754897197',
        'client_secret' => 'egd6u92387717b66afcd66399126d90',
        'redirect' => 'http://loclahost/auth/facebook/callback',
    ],
    'linkedin' => [
    'client_id' => '7787ysgi7ebw',
    'client_secret' => 'bLVf899iTWI0YcC',
    'redirect' => 'http://loclahost/callback/linkedin',
  ], 

];
