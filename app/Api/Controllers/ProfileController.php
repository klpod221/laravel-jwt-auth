<?php

namespace App\Api\Controllers;

use App\Services\UserService;
use App\Utils\ResponseUtility;
use App\Transformers\UserTransformer;
use App\Api\Controllers\BaseController;

class ProfileController extends BaseController
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * ProfileController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Get authenticated user profile
     *
     * @return mixed
     */
    public function show()
    {
        return responder()->data(auth()->user(), new UserTransformer());
    }
}
