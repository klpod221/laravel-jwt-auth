<?php

namespace App\Models\Traits\Method;

trait BaseMethod
{
    /**
     * @param $type
     * @param $field
     * @return array
     */
    public function getOption($type, $field)
    {
        $option = config("option.$type") ?? null;
        return collect($option)->where('id', $this->$field)->first() ?? null;
    }
}
