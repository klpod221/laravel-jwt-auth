<?php

namespace App\Api\Controllers\Auth;

use App\Utils\ResponseUtility;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke()
    {
        auth()->guard()->logout();
        return responder()->data(['message' => 'Logout success.']);
    }
}
