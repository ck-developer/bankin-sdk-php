<?php

namespace Bankin\Model;

class User extends Resource
{
    /**
     * @var string
     */
    public $uuid;

    /**
     * @var string
     */
    public $email;

    /**
     * User constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->uuid = $data['uuid'] ?? null;
        $this->email = $data['email'] ?? null;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}