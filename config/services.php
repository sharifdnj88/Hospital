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
    'github' => [
        'client_id' => '86cac7381a3819b87b35',
        'client_secret' => '5f8238c573dcd4c79fe812e277fec30b7d712d3a',
        'redirect' => 'http://localhost:8000/github-login-system',
    ],
    'facebook' => [
        'client_id' => '766613621054090',
        'client_secret' => '9853e15e8d03849a173e8df6599c941f',
        'redirect' => 'http://localhost:8000/facebook-login-system',
    ],
    'google' => [
        'client_id' => '602730716431-tnvppb5fu25kjh4f6hr443nkstmfrjds.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost:8000/google-login-system',
    ],

];
