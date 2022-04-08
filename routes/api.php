<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app(Router::class);
$api->version('v1', ['middleware' => ['api']], function ($api) {
    foreach (File::allFiles(__DIR__ . '/api') as $routeFile) {
        require $routeFile->getPathname();
    }
});
