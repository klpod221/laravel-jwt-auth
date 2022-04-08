<?php

namespace App\Models\Traits\Relation;

use App\Models\Category;

trait ProductRelation
{
    /**
     * @return mixed
     */
    public function categorys()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
