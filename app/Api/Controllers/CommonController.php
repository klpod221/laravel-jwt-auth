<?php

namespace App\Api\Controllers;

use App\Utils\ResponseUtility;

class CommonController extends BaseController
{
    /**
     * JobController constructor
     */
    public function __construct()
    {
    }

    /**
     * Get common Option
     * @return mixed
     */
    public function getOptions()
    {
        return responder()->data(config('option'));
    }

    /**
     * Get option by key
     *
     * @param $key
     * @return mixed
     */
    public function getOptionByKey($key)
    {
        return responder()->data(config("option.$key"));
    }
}
