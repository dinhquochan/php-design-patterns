<?php

namespace DesignPatterns\Adapter;

class RoseToProductAdapter implements ProductInterface
{
    /**
     * @var \DesignPatterns\Adapter\TheOldRoseInterface
     */
    private $rose;

    public function __construct(TheOldRoseInterface $rose)
    {
        $this->rose = $rose;
    }

    public function getDescription()
    {
        return null;
    }

    public function getPrice()
    {
        return $this->rose->getPriceFromDatabase();
    }

    public function getPicture()
    {
        return $this->rose->showImage();
    }

    public function sell()
    {
        $this->rose->sell();
    }
}
