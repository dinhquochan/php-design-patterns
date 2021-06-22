<?php

namespace DesignPatterns\Bridge;

abstract class PaymentMethod implements DirectPayment, CreditPayment
{
    /**
     * @var \DesignPatterns\Bridge\PaymentSource
     */
    private $paymentSource;

    abstract public function approve();

    abstract public function send();

    public function setPaymentSource(PaymentSource $paymentSource)
    {
        $this->paymentSource = $paymentSource;
    }

    protected function sendImpl()
    {
        $this->paymentSource->send();
    }

    protected function approveImpl()
    {
        $this->paymentSource->approve();
    }
}
