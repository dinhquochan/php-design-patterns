<?php

namespace DesignPatterns\Bridge;

interface CreditPayment
{
    public function send();

    public function approve();
}
