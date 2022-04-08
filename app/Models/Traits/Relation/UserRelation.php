<?php

namespace App\Models\Traits\Relation;

use App\Models\Access;
use App\Models\Category;

trait UserRelation
{
    /**
     * @return mixed
     */
    public function access()
    {
        return $this->hasOne(Access::class)->withDefault();
    }

    /**
     * @return mixed
     */
    public function categorys()
    {
        return $this->hasMany(Category::class, 'user_id');
    }
}
