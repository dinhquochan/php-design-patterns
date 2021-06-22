<?php

namespace DesignPatterns\Template;

abstract class Sell
{
    protected $price;

    protected $paymentProvider;
    protected $inventory;

    public function removeFromInventory()
    {
        $this->inventory->remove($this);
    }

    public function retrievePayment()
    {
        $this->paymentProvider->retrieve($this->price);
    }
}
