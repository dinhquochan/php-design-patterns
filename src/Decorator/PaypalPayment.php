<?php

namespace DesignPatterns\Decorator;

class PaypalPayment implements PaymentMethod
{
    public function getDescription()
    {
        return 'PaypalPayment';
    }
}
