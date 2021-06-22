<?php

namespace DesignPatterns\AbstractServer;

class ShopOwner
{
    /** @var \DesignPatterns\AbstractServer\Rose */
    private $rose;

    public function __construct(Rose $rose)
    {
        $this->rose = $rose;
    }

    public function sell()
    {
        $this->rose->sell();
    }
}
