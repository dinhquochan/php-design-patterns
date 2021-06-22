<?php

namespace DesignPatterns\Gateway;

use DesignPatterns\Factory\ShoppingCart;

class FileCart implements CartGateway
{
    private $fileId;

    public function __construct()
    {
        $this->fileId = uniqid();
    }

    public function persist(ShoppingCart $cart)
    {
        if (file_put_contents($this->fileId, serialize($cart) === false)) {
            return false;
        }

        return $this->fileId;
    }

    public function retrieve($id)
    {
        return unserialize(file_get_contents($id));
    }

    public function getIdOfRecordedCart()
    {
        return $this->fileId;
    }
}
