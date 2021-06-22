<?php

namespace DesignPatterns\Bridge;

class CreditPaymentMethod extends PaymentMethod
{
    public function approve()
    {
        parent::approveImpl();
    }

    public function send()
    {
        parent::sendImpl();
    }
}
