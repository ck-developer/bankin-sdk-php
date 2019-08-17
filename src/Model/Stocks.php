<?php

namespace Bankin\Model;

class Stocks extends Resources
{
    /**
     * @var Stock[];
     */
    protected $resources;

    /**
     * Stocks constructor.
     * 
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);
        
    }
}