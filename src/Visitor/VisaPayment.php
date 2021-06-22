<?php

namespace DesignPatterns\Visitor;

class VisaPayment implements PaymentMethod
{
    public function getDescription()
    {
        return 'Visa Description';
    }

    public function accept(PaymentVisitor $visitor)
    {
        $visitor->visit($this);
    }
}
