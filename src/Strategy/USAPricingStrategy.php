<?php

namespace DesignPatterns\Strategy;

class USAPricingStrategy implements PriceCalculator
{
    public function addTaxes(&$price)
    {
        return $price = $price * 0.1;
    }

    public function applyDiscounts(&$price)
    {
        return $price = $price - 50;
    }

    public function convertCurrencies(&$price)
    {
        return $price = $price * 1.0;
    }
}
