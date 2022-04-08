<?php

namespace App\Models;

class File extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'files';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'path',
        'type',
    ];

    // File types
    public const TYPE_IMAGE = 'image';
    public const TYPE_PRODUCT = 'product';
    public const TYPE_DOCUMENT = 'document';
}
