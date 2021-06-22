<?php

namespace DesignPatterns\Strategy;

interface PriceCalculator
{
    public function addTaxes(&$price);

    public function applyDiscounts(&$price);

    public function convertCurrencies(&$price);
}
