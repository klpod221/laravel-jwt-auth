<?php

use App\Api\Controllers\ProfileController;

/** @var Dingo\Api\Routing\Router $api */
$api->group(['middleware' => 'jwt.auth'], function ($api) {
    $api->get('/profile', [ProfileController::class, 'show']);
});
