<?php

namespace DesignPatterns\Strategy;

class EuropePricingStrategy implements PriceCalculator
{
    public function addTaxes(&$price)
    {
        return $price = $price * 0.2;
    }

    public function applyDiscounts(&$price)
    {
        return $price = $price - 20;
    }

    public function convertCurrencies(&$price)
    {
        return $price = $price * 0.7;
    }
}
