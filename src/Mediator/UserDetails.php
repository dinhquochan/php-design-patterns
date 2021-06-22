<?php

namespace DesignPatterns\Mediator;

class UserDetails extends Observable
{
    private $address;

    public function changeAddress($newAddress)
    {
        $this->address = $newAddress;
        $this->notify($newAddress);
    }
}
