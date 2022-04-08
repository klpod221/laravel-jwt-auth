<?php

namespace App\Api\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Services\UserService;
use App\Utils\ResponseUtility;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;

/**
 * Class VerificationController.
 */
class ConfirmationController extends Controller
{
    /**
     * @param $code
     * @param UserService $userService
     * @return \Illuminate\Http\JsonResponse|mixed
     * @throws \Throwable
     */
    public function __invoke($code, UserService $userService)
    {
        $userConfirmation = $userService->getByConfirmationCode($code);
        // Code does not match
        throw_if(
            !$userConfirmation,
            new GeneralException(config('error.confirmation_code_not_match'))
        );

        // Account confirmed or locked, deactivated
        throw_if(
            $userConfirmation->status !== User::STATUS_WAIT_ACTIVATION || $userConfirmation->access->verified_at,
            new GeneralException(config('error.account_confirmed'))
        );

        $confirmationDiffDays = carbon()->diffInDays($userConfirmation->created_at);
        throw_if(
            $confirmationDiffDays > config('const.verification_expire_time'),
            new GeneralException(config('error.confirmation_code_expired'))
        );

        $userService->updateConfirmation($userConfirmation);

        return responder()->updated();
    }
}
