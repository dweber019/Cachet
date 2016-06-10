<?php

/*
 * This file is part of Cachet.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (array_has($_ENV, 'VCAP_SERVICES')) {
    try {
        $vcapServices = json_decode($_ENV['VCAP_SERVICES']);
        if (property_exists($vcapServices, 'mariadb')) {
            $mariaDbConnection = head($vcapServices->mariadb)->credentials;

            putenv('DB_CONNECTION=mysql');
            putenv('DB_HOST=' . $mariaDbConnection->host);
            putenv('DB_PORT=' . $mariaDbConnection->port);
            putenv('DB_DATABASE=' . $mariaDbConnection->database);
            putenv('DB_USERNAME=' . $mariaDbConnection->username);
            putenv('DB_PASSWORD=' . $mariaDbConnection->password);
            putenv('APP_ENV=production');
            putenv('APP_DEBUG=false');
            putenv('APP_KEY=1234567890123456');
        }
    }
    catch (Exception $e) {
        dd($e->getMessage());
    }
}

return [

    /*
    |--------------------------------------------------------------------------
    | PDO Fetch Style
    |--------------------------------------------------------------------------
    |
    | By default, database results will be returned as instances of the PHP
    | stdClass object; however, you may desire to retrieve records in an
    | array format for simplicity. Here you can tweak the fetch style.
    |
    */

    'fetch' => PDO::FETCH_CLASS,

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_DRIVER', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver'   => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix'   => env('DB_PREFIX', null),
        ],

        'mysql' => [
            'driver'    => 'mysql',
            'host'      => env('DB_HOST', '127.0.0.1'),
            'database'  => env('DB_DATABASE', 'CF_E347CFF3_04F8_466B_AFEC_C64923AE771A'),
            'username'  => env('DB_USERNAME', 'wLQN40kn4DQCkfE9'),
            'password'  => env('DB_PASSWORD', 'bZ2uq1GOoZ2gbk1W'),
            'port'      => env('DB_PORT', '13000'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => env('DB_PREFIX', null),
            'strict'    => false,
            'engine'    => null,
        ],

        'pgsql' => [
            'driver'    => 'pgsql',
            'host'      => env('DB_HOST', null),
            'database'  => env('DB_DATABASE', null),
            'username'  => env('DB_USERNAME', null),
            'password'  => env('DB_PASSWORD', null),
            'port'      => env('DB_PORT', '5432'),
            'charset'   => 'utf8',
            'prefix'    => env('DB_PREFIX', null),
            'schema'    => env('DB_SCHEMA', 'public'),
        ],

        'sqlsrv' => [
            'driver'    => 'sqlsrv',
            'host'      => env('DB_HOST', null),
            'database'  => env('DB_DATABASE', null),
            'username'  => env('DB_USERNAME', null),
            'password'  => env('DB_PASSWORD', null),
            'port'      => env('DB_PORT', null),
            'prefix'    => env('DB_PREFIX', null),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'cluster' => false,

        'default' => [
            'host'     => env('REDIS_HOST', '127.0.0.1'),
            'port'     => env('REDIS_PORT', 6379),
            'database' => env('REDIS_DATABASE', 0),
            'password' => env('REDIS_PASSWORD', null),
        ],

    ],

];
