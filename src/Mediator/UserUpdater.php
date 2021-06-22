<?php

namespace DesignPatterns\Mediator;

class UserUpdater
{
    public function update($address)
    {
        $user = new UserDetails();
        $user->changeAddress($address);
    }
}
