<?php

namespace DesignPatterns\Observer;

class HardDisk extends ProductSubject
{
    private $price;

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
        $this->notify();
    }
}
