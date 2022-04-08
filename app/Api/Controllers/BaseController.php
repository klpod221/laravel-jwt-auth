<?php

namespace App\Api\Controllers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;

/**
 * @property \Dingo\Api\Http\Response\Factory $response
 */
class BaseController extends Controller
{
    use Helpers;
}
