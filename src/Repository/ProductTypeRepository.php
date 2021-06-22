<?php

namespace DesignPatterns\Repository;

class ProductTypeRepository
{
    /**
     * @var \DesignPatterns\Repository\TypeFactory
     */
    private $factory;

    /**
     * @var \DesignPatterns\Repository\TypeGateway
     */
    private $gateway;

    public function __construct(TypeFactory $factory, TypeGateway $gateway)
    {
        $this->factory = $factory;
        $this->gateway = $gateway;
    }

    public function findAll()
    {
        $types = $this->gateway->retrieveAll();

        return $this->makeAll($types);
    }

    public function findAllComputerHardware()
    {
        $types = $this->findAll();
        $types = array_filter(
            $types,
            function (ProductType $type) {
                return $type->category === 'Computer Hardware';
            }
        );

        return $types;
    }

    private function makeAll(array $typesData = [])
    {
        $types = [];

        foreach ($typesData as $data) {
            $types[] = $this->factory->make($data);
        }

        return $types;
    }
}
