<?php

namespace DesignPatterns\Gateway;

use DesignPatterns\Factory\ShoppingCart;

class InMemoryCart implements CartGateway
{
    private $listOfCarts;

    public function persist(ShoppingCart $cart)
    {
        $this->listOfCarts[] = $cart;

        return count($this->listOfCarts) - 1;
    }

    public function retrieve($id)
    {
        if (array_key_exists($id, $this->listOfCarts)) {
            return $this->listOfCarts[$id];
        }

        return null;
    }

    public function getIdOfRecordedCart()
    {
    }
}
