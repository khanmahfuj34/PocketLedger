<?php

declare(strict_types=1);

/**
 * PocketLedger Serverless Entrypoint for Vercel.
 *
 * Prepares writable directories in /tmp for AWS Lambda execution
 * and routes requests through Laravel's public/index.php.
 */

// 1. Ensure required storage directories exist in the writable /tmp volume
$tmpDirectories = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
    '/tmp/storage/app/public',
    '/tmp/bootstrap/cache',
];

foreach ($tmpDirectories as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// 2. Set environment flags for Vercel execution
putenv('VERCEL=1');
$_ENV['VERCEL'] = '1';
$_SERVER['VERCEL'] = '1';

// 3. Direct compiled views, caches, and logs to /tmp
putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');
putenv('APP_CONFIG_CACHE=/tmp/bootstrap/cache/config.php');
putenv('APP_SERVICES_CACHE=/tmp/bootstrap/cache/services.php');
putenv('APP_PACKAGES_CACHE=/tmp/bootstrap/cache/packages.php');
putenv('APP_ROUTES_CACHE=/tmp/bootstrap/cache/routes.php');
putenv('APP_EVENTS_CACHE=/tmp/bootstrap/cache/events.php');

// 4. Delegate to Laravel's public entrypoint
require __DIR__ . '/../public/index.php';

