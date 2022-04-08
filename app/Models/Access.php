<?php

namespace App\Models;

use App\Models\Traits\Method\AddressMethod;
use App\Models\Traits\Relation\AccesseRelation;

class Access extends BaseModel
{
    use AddressMethod;
    use AccesseRelation;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'accesses';

    public const VERIFY_TYPE_EMAIL = 1;
    public const VERIFY_TYPE_SMS = 2;
    public const SOCIAL_TYPE_FACEBOOK = 'facebook';
    public const SOCIAL_TYPE_GOOGLE = 'google';
    public const SOCIAL_TYPE_LINKEDIN = 'linkedin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'device_token',
        'provider',
        'provider_id',
        'confirmation_code',
        'verified_at',
        'verify_type',
        'last_login_at',
        'lock_expired_at',
        'fail_count'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
