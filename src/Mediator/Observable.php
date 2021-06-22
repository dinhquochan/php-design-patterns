<?php

namespace DesignPatterns\Mediator;

abstract class Observable
{
    protected $observers = [];

    public function register(Mediator $observer)
    {
        $this->observers[] = $observer;
    }

    public function unregister(Mediator $observer)
    {
        foreach ($this->observers as $index => $o) {
            if ($observer === $o) {
                unset($this->observers[$index]);
            }
        }
    }

    public function notify($hint)
    {
        foreach ($this->observers as $observer) {
            /** @var \DesignPatterns\Mediator\UserUpdater $observer */
            $observer->update($hint);
        }
    }
}
