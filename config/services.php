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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    /*
    |--------------------------------------------------------------------------
    | MTN SMS v3 API (Zambia)
    |--------------------------------------------------------------------------
    */
    'mtn_sms' => [
        'base_url'        => env('MTN_SMS_BASE_URL', 'https://api.mtn.com/v3/sms'),
        'token_url'       => env('MTN_SMS_TOKEN_URL', 'https://api.mtn.com/v1/oauth/access_token/accesstoken?grant_type=client_credentials'),
        'consumer_key'    => env('MTN_SMS_CONSUMER_KEY'),
        'consumer_secret' => env('MTN_SMS_CONSUMER_SECRET'),
        'sender_address'  => env('MTN_SMS_SENDER_ADDRESS', 'ZikoVB'),
        'service_code'    => env('MTN_SMS_SERVICE_CODE'),
        'country_code'    => env('MTN_SMS_COUNTRY_CODE', '260'),   // Zambia
        'delivery_receipt' => env('MTN_SMS_DELIVERY_RECEIPT', false),
    ],

];
