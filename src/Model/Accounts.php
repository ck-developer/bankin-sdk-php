<?php

namespace Bankin\Model;

/**
 * Class Accounts
 * 
 * @method Account[] toArray()
 * @method Account first()
 */
class Accounts extends Resources
{
    /**
     * @var Account[]
     */
    protected $resources;

    /**
     * Accounts constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->resources = array_map(function (array $data) {
            return new Account($data);
        }, $data['resources']);
    }
}