<?php

namespace App\Models\Traits\Attribute;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

trait UserAttribute
{
    /**
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        // If password was accidentally passed in already hashed, try not to double hash it
        $this->attributes['password'] =
            (strlen($password) === 60 && preg_match('/^\$2y\$/', $password)) ||
            (strlen($password) === 95 && preg_match('/^\$argon2i\$/', $password)) ? $password : Hash::make($password);
    }

    /**
     * @param $birthday
     * @throws \Exception
     */
    public function setBirthdayAttribute($birthday): void
    {
        $this->attributes['birthday'] = $birthday ? carbon()->createFromFormat(config('const.default_date_format'), $birthday) : null;
    }
}
