<?php

use App\Api\Controllers\ProductController;


/** @var Dingo\Api\Routing\Router $api */
$api->group(['prefix' => 'product'], function ($api) {
    $api->get('/', [ProductController::class, 'index']);
    $api->group(['middleware' => 'jwt.auth'], function ($api) {
        $api->post('/', [ProductController::class, 'store']);
    });

    $api->group(['prefix' => '{product}'], function ($api) {
        $api->get('/', [ProductController::class, 'show']);
    });
});
