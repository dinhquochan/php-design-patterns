<?php

namespace DesignPatterns\Decorator;

class VisaPayment implements PaymentMethod
{
    public function getDescription()
    {
        return 'VisaPayment';
    }
}
