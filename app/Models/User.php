<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Traits\Method\UserMethod;
use App\Models\Traits\Attribute\UserAttribute;
use App\Models\Traits\Relation\UserRelation;
use App\Models\Traits\Method\BaseMethod;
use App\Models\Traits\Scope\BaseScope;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory;
    use Notifiable;
    use UserMethod;
    use UserAttribute;
    use UserRelation;
    use BaseScope;
    use BaseMethod;

    // User types
    public const TYPE_ADMIN = 'admin'; // For human resource account
    public const TYPE_CANDIDATE = 'candidate'; // For candidate account

    // User statuses
    public const STATUS_WAIT_ACTIVATION = 'wait_activation';
    public const STATUS_ACTIVATED = 'activated';
    public const STATUS_DEACTIVATED = 'deactivated';
    public const STATUS_LOCKED = 'locked'; // Need included with the lock time

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'birthday',
        'gender',
        'marital',
        'type',
        'address',
        'provider',
        'provider_id',
        'id_card',
        'avatar',
        'status',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'address' => 'array',
        'id_card' => 'array',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
