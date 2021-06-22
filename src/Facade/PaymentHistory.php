<?php

namespace DesignPatterns\Facade;

class PaymentHistory
{
    public function findPaymentsForClient($clientId)
    {
        return [50, 150, 20, 15];
    }
}
