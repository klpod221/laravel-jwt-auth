<?php

use App\Api\Controllers\CommonController;

/** @var Dingo\Api\Routing\Router $api */
$api->group(['prefix' => 'common'], function ($api) {
    $api->get('options', [CommonController::class, 'getOptions']);
    $api->get('options/{key}', [CommonController::class, 'getOptionByKey']);
});
