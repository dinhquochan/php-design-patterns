<?php

namespace DesignPatterns\State;

class AtDestination implements DeliveryState
{
    public function goNext(Delivery $delivery)
    {
        $delivery->setState(new AtDestination());
    }

    public function getLocation()
    {
        return 'Final Destination';
    }
}
