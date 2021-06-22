<?php

namespace DesignPatterns\State;

class Processing implements DeliveryState
{
    public function goNext(Delivery $delivery)
    {
        $delivery->setState(new OnRoute());
    }

    public function getLocation()
    {
        return 'Warehouse';
    }
}
