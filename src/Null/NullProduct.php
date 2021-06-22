<?php

namespace DesignPatterns\Null;

use DesignPatterns\Factory\Product;

class NullProduct implements Product
{
    public function getPrice()
    {
        return 0;
    }

    public function getPicture()
    {
        return 'images/default.png';
    }

    public function getDescription()
    {
        return '';
    }
}
