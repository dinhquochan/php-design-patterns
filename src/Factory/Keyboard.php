<?php

namespace DesignPatterns\Factory;

class Keyboard implements Product
{
    public function getPrice()
    {
        return 50;
    }

    public function getPicture()
    {
        return null;
    }

    public function getDescription()
    {
        return 'Simple Description';
    }
}
