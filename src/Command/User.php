<?php

namespace DesignPatterns\Command;

class User
{
    private $paymentMethod;

    /**
     * @return \DesignPatterns\Command\VisaPayment|\DesignPatterns\Command\PaypalPayment
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }
}
