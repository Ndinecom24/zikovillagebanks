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
        'tns'            => env('PROD_DB_TNS', ''),
        'host'           => env('PROD_DB_HOST', '10.1.101.136'),
        'port'           => env('PROD_DB_PORT', '1521'),
        'database'       => env('PROD_DB_DATABASE', 'ISDPROD'),
        'service_name'   => env('PROD_DB_SERVICENAME', ''),
        'username'       => env('PROD_DB_USERNAME', 'ISDADMIN'),
        'password'       => env('PROD_DB_PASSWORD', '1sd@dm1n123'),
        'charset'        => env('PROD_DB_CHARSET', 'AL32UTF8'),
        'prefix'         => env('PROD_DB_PREFIX', ''),
        'prefix_schema'  => env('PROD_DB_SCHEMA_PREFIX', ''),
        'edition'        => env('PROD_DB_EDITION', 'ora$base'),
        'server_version' => env('PROD_DB_SERVER_VERSION', '11g'),
        'load_balance'   => env('PROD_DB_LOAD_BALANCE', 'yes'),
        'dynamic'        => [],
    ],


];
