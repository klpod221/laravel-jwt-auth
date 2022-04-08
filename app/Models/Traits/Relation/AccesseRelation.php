<?php

namespace App\Models\Traits\Relation;

use App\Models\User;

trait AccesseRelation
{
    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
