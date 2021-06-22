<?php

namespace DesignPatterns\State;

class Delivery
{
    /**
     * @var \DesignPatterns\State\DeliveryState
     */
    private $currentState;

    public function __construct(DeliveryState $state)
    {
        $this->setState($state);
    }

    public function getCurrentLocation()
    {
        return $this->currentState->getLocation();
    }

    public function goNext()
    {
        return $this->currentState->goNext($this);
    }

    public function setState(DeliveryState $state)
    {
        $this->currentState = $state;
    }
}
