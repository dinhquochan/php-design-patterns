<?php

namespace DesignPatterns\Factory;

class ShoppingCart
{
    private $productsInTheCart = [];

    /**
     * @var \DesignPatterns\Factory\ProductFactory
     */
    private $productFactory;

    public function __construct()
    {
        $this->productFactory = new ProductFactory();
    }

    public function add($productId)
    {
        $this->productsInTheCart[] = $this->productFactory->make($productId);
    }

    /**
     * @return array
     */
    public function getProductsInTheCart()
    {
        return $this->productsInTheCart;
    }
}
