<?php

namespace App\Utils;

class OptionUtility
{
    /**
     * @param $type
     * @param $id
     * @return mixed|null
     */
    public static function get($type, $id = null)
    {
        $options = config("option.$type");
        return $id ? collect($options)->where('id', $id)->first() ?? null : $options;
    }

    /**
     * @param $type
     * @return array
     */
    public static function getFlatIDs($type)
    {
        return collect(config("option.$type"))->pluck('id')->toArray();
    }
}
