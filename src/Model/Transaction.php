<?php

namespace Bankin\Model;

class Transaction extends Resource
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $rawDescription;

    /**
     * @var int
     */
    private $category;

    /**
     * @var int
     */
    private $accountId;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var \DateTimeImmutable
     */
    private $date;

    /**
     * @var \DateTimeImmutable
     */
    private $updatedAt;

    /**
     * @var bool
     */
    private $deleted;

    /**
     * Transaction constructor.
     *
     * @param array $data
     * @throws \Exception
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->id = $data['id'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->rawDescription = $data['raw_description'] ?? null;
        $this->accountId = $data['account']['id'] ?? null;
        $this->category = $data['category']['id'] ?? null;
        $this->amount = $data['amount'] ?? null;

        if (isset($data['category'])) {
            $this->category = new \DateTimeImmutable($data['date']);
        }

        if (isset($data['date'])) {
            $this->date = new \DateTimeImmutable($data['date']);
        }

        if (isset($data['updated_at'])) {
            $this->updatedAt = new \DateTimeImmutable($data['updated_at']);
        }

        $this->deleted = $data['is_deleted'] ?? null;
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
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getRawDescription(): string
    {
        return $this->rawDescription;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    /**
     * @return int
     */
    public function getAccountId(): int
    {
        return $this->accountId;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }
}