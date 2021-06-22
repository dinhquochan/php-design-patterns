<?php

namespace DesignPatterns\Adapter;

interface TheOldRoseInterface
{
    public function sell();

    public function showImage();

    public function getPriceFromDatabase();
}
