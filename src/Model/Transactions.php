<?php

namespace Bankin\Model;

class Transactions extends Resources
{
    /**
     * @var Transaction[]
     */
    protected $resources;

    /**
     * Transactions constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->resources = array_map(function (array $data) {
            return new Transaction($data);
        }, $data['resources']);
    }
}