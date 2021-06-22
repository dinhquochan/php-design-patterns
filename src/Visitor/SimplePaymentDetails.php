<?php

namespace DesignPatterns\Visitor;

class SimplePaymentDetails implements PaymentVisitor
{
    private $description;

    public function visit(PaymentMethod $paymentMethod)
    {
        $this->description = $paymentMethod->getDescription();
    }

    public function getDescription()
    {
        return $this->description;
    }
}
