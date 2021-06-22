<?php

namespace DesignPatterns\Adapter;

interface ProductInterface
{
    public function getDescription();

    public function getPrice();

    public function getPicture();

    public function sell();
}
