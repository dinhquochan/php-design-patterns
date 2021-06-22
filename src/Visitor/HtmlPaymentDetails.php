<?php

namespace DesignPatterns\Visitor;

class HtmlPaymentDetails implements PaymentVisitor
{
    private $description;

    public function visit(PaymentMethod $paymentMethod)
    {
        $this->description = "<html><body><div>{$paymentMethod->getDescription()}</div></body></html>";
    }

    public function getDescription()
    {
        return $this->description;
    }
}
