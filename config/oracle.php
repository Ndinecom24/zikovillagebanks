<?php

return [
    'oracle' => [
        'driver'         => 'oracle',
        'tns'            => env('DB_TNS', ''),
        'host'           => env('DB_HOST', ''),
        'port'           => env('REMS_DB_PORT', '1521'),
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
        'tns'            => env('prod_db_tns', ''),
        'host'           => env('prod_db_host', '10.1.101.136'),
        'port'           => env('prod_db_port', '1521'),
        'database'       => env('prod_db_database', 'isdprod'),
        'service_name'   => env('prod_db_servicename', ''),
        'username'       => env('prod_db_username', 'isdadmin'),
        'password'       => env('prod_db_password', '1sd@dm1n123'),
        'charset'        => env('prod_db_charset', 'al32utf8'),
        'prefix'         => env('prod_db_prefix', ''),
        'prefix_schema'  => env('prod_db_schema_prefix', ''),
        'edition'        => env('prod_db_edition', 'ora$base'),
        'server_version' => env('prod_db_server_version', '11g'),
        'load_balance'   => env('prod_db_load_balance', 'yes'),
        'dynamic'        => [],
    ],


];
