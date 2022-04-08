<?php

namespace App\Api\Controllers\Auth;

use App\Utils\ResponseUtility;
use App\Events\User\UserLoggedIn;
use App\Exceptions\GeneralException;
use App\Api\Controllers\BaseController;
use App\Api\Requests\Auth\LoginRequest;

class LoginController extends BaseController
{
    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse|mixed
     * @throws \Throwable
     */
    public function __invoke(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        $token = auth()->guard()->attempt($credentials);
        if (!$token) {
            throw new GeneralException(config('error.credential_not_match'));
        }

        $loggedInUser = $request->user();
        throw_if($loggedInUser->isWaitActivation(), new GeneralException(config('error.account_not_confirmed')));
        throw_if($loggedInUser->isDeactivated(), new GeneralException(config('error.account_deactivated')));
        throw_if($loggedInUser->isLocked(), new GeneralException(config('error.account_locked')));

        event(new UserLoggedIn($loggedInUser));

        return responder()->data([
            'token' => $token,
            'expires_in' => auth()->guard()->factory()->getTTL() * 60
        ]);
    }
}
