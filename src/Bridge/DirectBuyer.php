<?php

namespace DesignPatterns\Bridge;

class DirectBuyer
{
    public function payNow(DirectPayment $payment)
    {
        $payment->send();
    }
}
