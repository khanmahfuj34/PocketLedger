<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
$autoloaderPaths = [
    __DIR__.'/../vendor/autoload.php',
    __DIR__.'/../../vendor/autoload.php',
    dirname(__DIR__).'/vendor/autoload.php',
    '/var/task/user/pocketledger/vendor/autoload.php',
    '/var/task/user/vendor/autoload.php',
];

$autoloaderLoaded = false;
foreach ($autoloaderPaths as $path) {
    if (file_exists($path)) {
        require $path;
        $autoloaderLoaded = true;
        break;
    }
}

if (! $autoloaderLoaded) {
    require __DIR__.'/../vendor/autoload.php';
}

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
