<?php

namespace DesignPatterns\Bridge;

class CreditBuyer
{
    public function payNow(CreditPayment $payment)
    {
        if ($payment->approve()) {
            $payment->send();
        }
    }
}
