<?php

namespace DesignPatterns\Repository;

class TypeGateway
{
    public function retrieve($id)
    {
        // Here should be some complicated logic returning the type.
    }

    /**
     * @return array
     */
    public function retrieveAll()
    {
        // Here should be some complicated logic returning all types.
    }
}
