<?php

namespace DesignPatterns\Null;

use DesignPatterns\Factory\Product;

class Receipt
{
    private $products;

    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    public function getTotal()
    {
        $total = 0;

        foreach ($this->products as $product) {
            /** @var \DesignPatterns\Factory\Product $product */
            $total += $product->getPrice();
        }

        return $total;
    }

    public function addProductById($id)
    {
        $provider = new ProductProvider();
        $product = $provider->findProduct($id);
        $this->addProduct($product);
    }
}
