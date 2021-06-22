<?php

namespace DesignPatterns\Facade;

class ClientFacade
{
    public function getAllClientData($clientId)
    {
        return [
            $clientId,
            $this->getClientAddress($clientId),
            $this->getMostPayedFor($clientId),
            $this->getPaymentHistory($clientId),
        ];
    }

    private function getClientAddress($clientId)
    {
        $clientShippingAddress = '';
        $clientPersonalData = new ClientPersonalData($clientId);
        $clientShippingAddress = ", {$clientPersonalData->getStreetAddress()}";
        $clientShippingAddress .= ", {$clientPersonalData->getCountry()}";
        $clientShippingAddress .= ", {$clientPersonalData->getPostalCode()}";

        return $clientShippingAddress;
    }

    private function getMostPayedFor($clientId)
    {
        $topPayments = new TopPayments();

        return $topPayments->findMaxForClientWithId($clientId);
    }

    private function getPaymentHistory($clientId)
    {
        $paymentHistory = new PaymentHistory();

        return $paymentHistory->findPaymentsForClient($clientId);
    }
}
