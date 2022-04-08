<?php

namespace App\Models\Traits\Scope;

trait BaseScope
{
    /**
     * @param $query
     * @return mixed
     */
    public function scopeSortNewest($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActivated($query)
    {
        return $query->where('status', self::STATUS_ACTIVATED);
    }

    /**
     * @param $query
     * @param $column
     * @param $field
     * @param $value
     * @return mixed
     */
    public function scopeWhereMatchJsonb($query, $column, $field, $value) {
        return $query->where($column, '@>', "[".json_encode([$field => $value])."]");
    }

    /**
     * @param $query
     * @param $column
     * @param $field
     * @param $value
     * @return mixed
     */
    public function scopeOrWhereMatchJsonb($query, $column, $field, $value) {
        return $query->orWhere($column, '@>', "[".json_encode([$field => $value])."]");
    }
}
