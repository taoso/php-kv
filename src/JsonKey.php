<?php
namespace Lvht\Key;

class JsonKey extends Key
{
    const JSON_OPTS = JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_LINE_TERMINATORS;

    public function get(string $key)
    {
        $value = parent::get($key);
        if (is_null($value)) {
            return $value;
        }

        return json_decode($value);
    }

    public function set(string $key, $value)
    {
        return parent::set($key, json_encode($value, self::JSON_OPTS));
    }
}
