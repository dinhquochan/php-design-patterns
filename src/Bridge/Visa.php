<?php

namespace DesignPatterns\Bridge;

class Visa implements PaymentSource
{
    public function approve()
    {
        // TODO: Talk to the bank and approve the sum
    }

    public function send()
    {
        // TODO: Transfer the money
    }
}
