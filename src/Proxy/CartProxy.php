<?php

namespace DesignPatterns\Proxy;

class CartProxy implements Cart
{
    private $shoppingCart;

    public function getProducts()
    {
        if (is_null($this->shoppingCart)) {
            $this->shoppingCart = new ShoppingCart();
        }

        return $this->shoppingCart->getProducts();
    }
}
