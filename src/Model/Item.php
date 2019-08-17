<?php

namespace Bankin\Model;

class Item extends Resource
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var int|null
     */
    private $status;

    /**
     * @var Bank
     */
    private $bank;

    /**
     * @var Account[]|array
     */
    private $accounts;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->id = $data['id'] ?? null;
        $this->status = $data['status'] ?? null;

        if (isset($data['bank'])) {
            $this->bank = new Bank($data['bank']);
        }

        if (isset($data['accounts'])) {
            $this->accounts = array_map(function (array $data) {
                return new Account($data);
            }, $data['accounts']);
        }
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @return Bank
     */
    public function getBank(): Bank
    {
        return $this->bank;
    }

    /**
     * @return array|Account[]
     */
    public function getAccounts()
    {
        return $this->accounts;
    }
}