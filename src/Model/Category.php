<?php

namespace Bankin\Model;

class Category extends Resource
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $name;

    /**
     * @var Category
     */
    private $parent;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;

        if (isset($data['parent'])) {
            $this->parent = new Category($data['parent']);
        }
    }
}