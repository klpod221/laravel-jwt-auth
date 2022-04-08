<?php

namespace App\Services;

use App\Models\Access;

/**
 * Class AccessService
 * @package App\Services
 */
class AccessService extends BaseService
{
    /**
     * AccessService constructor.
     *
     * @param Access $access
     */
    public function __construct(Access $access)
    {
        $this->model = $access;
    }
}
