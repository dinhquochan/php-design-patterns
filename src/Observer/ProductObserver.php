<?php

namespace DesignPatterns\Observer;

interface ProductObserver
{
    public function __construct(ProductSubject $subject);

    public function update();
}
