<?php

namespace DesignPatterns\EventDispatcher;

class EventManager
{
    private $listeners = [];

    public function listen($event, \Closure $callback)
    {
        $this->listeners[$event][] = $callback;
    }

    public function dispatch($event, SenderInterface $sender)
    {
        if (array_key_exists($event, $this->listeners)) {
            foreach ($this->listeners[$event] as $listener) {
                call_user_func_array($listener, [$sender]);
            }
        }
    }
}
