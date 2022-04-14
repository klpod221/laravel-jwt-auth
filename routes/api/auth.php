<?php

use App\Api\Controllers\Auth\LoginController;
use App\Api\Controllers\Auth\LogoutController;
use App\Api\Controllers\Auth\RegisterController;
use App\Api\Controllers\Auth\ConfirmationController;

/** @var Dingo\Api\Routing\Router $api */
$api->group(['prefix' => 'api/auth'], function ($api) {
    $api->post('login', LoginController::class);
    $api->post('register', RegisterController::class);
    $api->post('logout', LogoutController::class);
    $api->get('confirm/{code}', ConfirmationController::class);
});
