<?php

namespace Bankin\Model;

class Synchronization
{
    /**
     * @var string|null
     */
    private $status;

    /**
     * @var array
     */
    private $mfa;

    /**
     * @var \DateTimeImmutable|null
     */
    private $refreshedAt;

    /**
     * @var int
     */
    private $refreshedAccountsCount;

    /**
     * @var int
     */
    private $totalAccountsCount;

    public function __construct(array $data)
    {
        $this->status = $data['status'] ?? null;
        $this->mfa = $data['mfa'] ?? null;

        if (isset($data['refreshed_at'])) {
            $this->refreshedAt = new \DateTimeImmutable($data['refreshed_at']);
        }

        $this->refreshedAccountsCount = $data['refreshed_accounts_count'] ?? 0;
        $this->totalAccountsCount = $data['total_accounts_count'] ?? 0;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @return array
     */
    public function getMfa(): array
    {
        return $this->mfa;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getRefreshedAt(): ?\DateTimeImmutable
    {
        return $this->refreshedAt;
    }

    /**
     * @return int
     */
    public function getRefreshedAccountsCount(): int
    {
        return $this->refreshedAccountsCount;
    }

    /**
     * @return int
     */
    public function getTotalAccountsCount(): int
    {
        return $this->totalAccountsCount;
    }
}