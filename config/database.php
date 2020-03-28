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
            'host' => "127.0.0.1",
            'username' => "ahmetbedir",
            'password' => "",
            'database' => "mvc",
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
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
