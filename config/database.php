<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Varsayılan Veritabanı Bağlantı Adı
    |--------------------------------------------------------------------------
    |
    | Buraya kullanılacak veritabanı adını belirtiniz.
    |
     */
    'default' => 'mysql',

    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => "192.168.65.2",
            'username' => "admin",
            'password' => "1021**",
            'database' => "skeleton",
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
        ],
        'sqlsrv' => [
            // Microsoft SQL Server
        ],
        'pgsql' => [
            // PostgreSQL
        ],
    ],
];
