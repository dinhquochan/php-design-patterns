<?php

namespace DesignPatterns\Monostate;

class Monostate
{
    private static $value;

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        static::$value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return static::$value;
    }
}
