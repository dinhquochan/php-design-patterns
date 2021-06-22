<?php

namespace DesignPatterns\Mediator;

class OrderDelivery implements UserAddress
{
    private $deliveryAddress;

    public function setAddress($address)
    {
        $this->deliveryAddress = $address;
    }
}
