<?php

namespace App\Models;

use App\Models\Traits\Relation\CategoryRelation;

class Category extends BaseModel
{
    use CategoryRelation;

    // Category statuses
    public const STATUS_WAIT_ACTIVATION = 'wait_activation';
    public const STATUS_ACTIVATED = 'activated';
    public const STATUS_DEACTIVATED = 'deactivated';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categorys';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'status'
    ];
}
