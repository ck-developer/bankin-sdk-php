<?php

namespace Bankin\Model;

class Account extends Resource
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var float
     */
    private $balance;

    /**
     * @var string
     */
    private $currencyCode;

    /**
     * @var int
     */
    private $status;

    /**
     * @var Item
     */
    private $item;

    /**
     * @var Bank
     */
    private $bank;

    /**
     * @var \DateTimeImmutable
     */
    private $updatedAt;

    /**
     * Account constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->type = $data['type'] ?? null;
        $this->balance = $data['balance'] ?? null;
        $this->currencyCode = $data['currency_code'] ?? null;
        $this->status = $data['status'] ?? null;

        if (isset($data['item'])) {
            $this->item = new Item($data['item']);
        }

        if (isset($data['bank'])) {
            $this->bank = new Bank($data['bank']);
        }

        if (isset($data['updated_at'])) {
            $this->updatedAt = new \DateTimeImmutable($data['updated_at']);
        }
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return Item
     */
    public function getItem(): Item
    {
        return $this->item;
    }

    /**
     * @return Bank
     */
    public function getBank(): Bank
    {
        return $this->bank;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getLastRefreshDate(): \DateTimeImmutable
    {
        return $this->lastRefreshDate;
    }
}