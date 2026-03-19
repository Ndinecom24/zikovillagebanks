<?php

return [
    'oracle' => [
        'driver'         => 'oracle',
        'tns'            => env('DB_TNS', ''),
        'host'           => env('DB_HOST', ''),
        'port'           => env('DB_PORT', '1521'),
        'database'       => env('DB_DATABASE', ''),
        'service_name'   => env('DB_SERVICENAME', ''),
        'username'       => env('DB_USERNAME', ''),
        'password'       => env('DB_PASSWORD', ''),
        'charset'        => env('DB_CHARSET', 'AL32UTF8'),
        'prefix'         => env('DB_PREFIX', ''),
        'prefix_schema'  => env('DB_SCHEMA_PREFIX', ''),
        'edition'        => env('DB_EDITION', 'ora$base'),
        'server_version' => env('DB_SERVER_VERSION', '11g'),
        'load_balance'   => env('DB_LOAD_BALANCE', 'yes'),
        'max_name_len'   => env('ORA_MAX_NAME_LEN', 30),
        'dynamic'        => [],
    ],

    'oracle_isd' => [
        'driver'         => 'oracle',
        'tns'            => env('ISD_DB_TNS', ''),
        'host'           => env('ISD_DB_HOST', ''),
        'port'           => env('ISD_DB_PORT', '1521'),
        'database'       => env('ISD_DB_DATABASE', ''),
        'service_name'   => env('ISD_DB_SERVICENAME', ''),
        'username'       => env('ISD_DB_USERNAME', ''),
        'password'       => env('ISD_DB_PASSWORD', ''),
        'charset'        => env('ISD_DB_CHARSET', 'AL32UTF8'),
        'prefix'         => env('DB_PREFIX', ''),
        'prefix_schema'  => env('DB_SCHEMA_PREFIX', ''),
        'edition'        => env('DB_EDITION', 'ora$base'),
        'server_version' => env('ISD_DB_SERVER_VERSION', '11g'),
        'load_balance'   => env('DB_LOAD_BALANCE', 'yes'),
        'dynamic'        => [],
    ],


];
