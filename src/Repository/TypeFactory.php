<?php

namespace DesignPatterns\Repository;

class TypeFactory
{
    public function make(array $data = [])
    {
        if (!$data) {
            return null;
        }

        return new ProductType($data['name'], $data['category'], $data['code']);
    }
}
