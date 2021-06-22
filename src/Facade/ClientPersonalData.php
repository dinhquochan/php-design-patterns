<?php

namespace DesignPatterns\Facade;

class ClientPersonalData
{
    private $streetAddress;
    private $postalCode;
    private $country;

    public function __construct($clientId)
    {
    }

    public function getStreetAddress()
    {
        return $this->streetAddress;
    }

    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function getCountry()
    {
        return $this->country;
    }
}
