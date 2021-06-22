<?php

namespace DesignPatterns\Bridge;

interface PaymentSource
{
    public function approve();

    public function send();
}
