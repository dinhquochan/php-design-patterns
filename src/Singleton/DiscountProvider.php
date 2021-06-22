<?php

namespace DesignPatterns\Singleton;

class DiscountProvider
{
    private static $instance;

    private function __construct()
    {
    }

    /**
     * @return \DesignPatterns\Singleton\DiscountProvider
     */
    public static function getInstance()
    {
        if (!(static::$instance instanceof DiscountProvider)) {
            static::$instance = new DiscountProvider();
        }

        return static::$instance;
    }

    /**
     * @param int $productId
     *
     * @return int
     */
    public function getDiscountFor($productId)
    {
        // return discount
    }
}
