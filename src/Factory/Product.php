<?php

namespace DesignPatterns\Factory;

interface Product
{
    public function getPrice();

    public function getPicture();

    public function getDescription();
}
