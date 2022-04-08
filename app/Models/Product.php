<?php

namespace App\Models;

use App\Models\Traits\Relation\ProductRelation;

class Product extends BaseModel
{
    use ProductRelation;

    public const STATUS_WAIT_ACTIVATION = 'wait_activation';
    public const STATUS_ACTIVATED = 'activated';
    public const STATUS_DEACTIVATED = 'deactivated';

    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'status',
        'file_ids'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'file_ids' => 'json'
    ];
}
