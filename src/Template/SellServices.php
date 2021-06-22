<?php

namespace DesignPatterns\Template;

class SellServices extends Sell
{
    private $humanResources;

    public function markHumanResourcesAsOccupied()
    {
        $this->humanResources->mark(2);
    }
}
