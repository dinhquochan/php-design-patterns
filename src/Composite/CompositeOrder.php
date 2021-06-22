<?php

namespace DesignPatterns\Composite;

class CompositeOrder implements Order
{
    private $orders = [];

    public function add(Order $order)
    {
        $this->orders[] = $order;
    }

    public function place()
    {
        foreach ($this->orders as $order) {
            /** @var \DesignPatterns\Composite\Order $order */
            $order->place();
        }
    }
}
