<?php

namespace DesignPatterns\Command;

class PaymentProcessor
{
    public function processUserPayment($username)
    {
        $user = new User($username);
        $paymentMethod = $user->getPaymentMethod();

        $this->executePayment($paymentMethod);
    }

    private function executePayment(PaymentMethod $paymentMethod)
    {
        try {
            $paymentMethod->execute();
        } catch (\Exception $e) {
            throw new PaymentProcessingException(
                "Paying with {$paymentMethod} has failed with error {$e->getMessage()}"
            );
        }
    }
}
