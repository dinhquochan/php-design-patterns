<?php

namespace DesignPatterns\Decorator;

abstract class PaymentDecorator
{
    /**
     * @var \DesignPatterns\Decorator\PaymentMethod
     */
    protected $paymentMethod;

    public function __construct(PaymentMethod $paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    public function getDescription()
    {
        $this->paymentMethod->getDescription();
    }
}
