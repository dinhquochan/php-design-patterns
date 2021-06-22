<?php

namespace DesignPatterns\Repository;

class ProductType
{
    private $name;

    private $category;

    private $code;

    public function __construct($name, $category, $code)
    {
        $this->name = $name;
        $this->category = $category;
        $this->code = $code;
    }

    public function __get($property)
    {
        if (!isset($this->$property)) {
            throw new \Exception('No such property');
        }

        return $this->$property;
    }
}
