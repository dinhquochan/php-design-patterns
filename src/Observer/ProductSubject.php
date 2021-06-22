<?php

namespace DesignPatterns\Observer;

abstract class ProductSubject
{
    private $observers = [];

    public function register(ProductObserver $observer)
    {
        $this->observers[] = $observer;
    }

    protected function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }
}
