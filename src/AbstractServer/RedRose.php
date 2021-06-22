<?php

namespace DesignPatterns\AbstractServer;

class RedRose implements Rose
{
    private $sold = false;

    public function sell()
    {
        $this->sold = true;
    }

    public function isSold()
    {
        return $this->sold;
    }
}
