<?php

namespace Bankin\Model;

class Users extends Resources
{
    /**
     * @var User[]
     */
    protected $resources;

    /**
     * User constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->resources = array_map(function (array $data) {
            return new User($data);
        }, $data['resources']);
    }
}
