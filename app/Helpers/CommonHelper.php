<?php

use Carbon\Carbon;

if (!function_exists('appName')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function appName()
    {
        return config('app.name', 'project');
    }
}

if (!function_exists('carbon')) {
    /**
     * Create a new Carbon instance
     *
     * @return Carbon
     */
    function carbon()
    {
        return new Carbon();
    }
}

if (!function_exists('option')) {
    /**
     * Create a new OptionUtility instance
     *
     * @return \App\Utils\OptionUtility
     */
    function option()
    {
        return app('option');
    }
}

if (!function_exists('responder')) {
    /**
     * Get custom response utility
     *
     * @return \App\Utils\ResponseUtility
     */
    function responder()
    {
        return app('responder');
    }
}

if (!function_exists('apiRoute')) {
    /**
     * Get api route by custom by Dingo
     *
     * @return \Dingo\Api\Routing\Router|\Illuminate\Contracts\Foundation\Application|mixed
     */
    function apiRoute()
    {
        return app(Dingo\Api\Routing\Router::class);
    }
}
