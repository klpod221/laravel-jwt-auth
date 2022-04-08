<?php

namespace App\Models\Traits\Relation;

use App\Models\Product;
use App\Models\User;

trait CategoryRelation
{
    /**
     * @return mixed
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    /**
     * @return mixed
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
