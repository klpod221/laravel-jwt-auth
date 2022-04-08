<?php

namespace App\Api\Controllers\Auth;

use Tymon\JWTAuth\JWTAuth;
use App\Services\UserService;
use App\Utils\ResponseUtility;
use App\Exceptions\GeneralException;
use App\Api\Controllers\BaseController;
use App\Api\Requests\Auth\RegisterRequest;

class RegisterController extends BaseController
{
    /**
     * @param RegisterRequest $request
     * @param UserService $userService
     * @param JWTAuth $JWTAuth
     * @return \Illuminate\Http\JsonResponse|mixed
     * @throws \Throwable
     */
    public function __invoke(RegisterRequest $request, UserService $userService, JWTAuth $jwtAuth)
    {
        $emailExisted = $userService->checkByColumn('email', $request->get('email'));
        throw_if($emailExisted, new GeneralException(config('error.email_already_use')));

        $phoneExisted = $userService->checkByColumn('phone', $request->get('phone'));
        throw_if($phoneExisted, new GeneralException(config('error.phone_already_use')));

        $user = $userService->create($request->all());
        throw_if(!$user, new GeneralException('Cannot create new user.'));

        return responder()->created();
    }
}
