<?php

namespace DesignPatterns\Mediator;

class Mediator
{
    /**
     * @var \DesignPatterns\Mediator\Observable
     */
    private $observedClass;

    /**
     * @var \DesignPatterns\Mediator\UserAddress
     */
    private $affectedClass;

    public function __construct(Observable $observedClass, UserAddress $affectedClass)
    {
        $this->observedClass = $observedClass;
        $this->affectedClass = $affectedClass;
        $this->observedClass->register($this);
    }

    public function update($address)
    {
        $this->affectedClass->setAddress($address);
    }
}
