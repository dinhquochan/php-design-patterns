<?php

namespace DesignPatterns\Visitor;

interface PaymentVisitor
{
    public function visit(PaymentMethod $paymentMethod);

    public function getDescription();
}
