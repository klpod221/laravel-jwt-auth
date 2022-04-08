<?php

namespace App\Models\Traits\Method;

trait UserMethod
{
    /**
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->id === env('SUPER_ADMIN_ID');
    }

    /**
     * @return mixed
     */
    public function isAdmin(): bool
    {
        return $this->type === self::TYPE_ADMIN;
    }

    /**
     * @return mixed
     */
    public function isCandidate(): bool
    {
        return $this->type === self::TYPE_CANDIDATE;
    }

    /**
     * @return bool
     */
    public function isWaitActivation(): bool
    {
        return $this->status === self::STATUS_WAIT_ACTIVATION;
    }

    /**
     * @return bool
     */
    public function isActivated(): bool
    {
        return $this->status === self::STATUS_ACTIVATED;
    }

    /**
     * @return bool
     */
    public function isLocked(): bool
    {
        return $this->status === self::STATUS_LOCKED;
    }

    /**
     * @return bool
     */
    public function isDeactivated(): bool
    {
        return $this->status === self::STATUS_DEACTIVATED;
    }
}
