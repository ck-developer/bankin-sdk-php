<?php

namespace Bankin\Model;

class AccessToken
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private $token;

    /**
     * @var \DateTimeImmutable|null
     */
    private $expiresAt;

    /**
     * AccessToken constructor.
     * @param array $data
     *
     * @throws \Exception
     */
    public function __construct(array $data)
    {
        $this->user = new User($data['user'] ?? []) ?? null;
        $this->token = $data['access_token'] ?? null;
        $this->expiresAt = new \DateTimeImmutable($data['expires_at']) ?? null;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getExpiresAt(): ?\DateTimeImmutable
    {
        return $this->expiresAt;
    }

    /**
     * @return bool
     *
     * @throws \Exception
     */
    public function isExpired()
    {
        return $this->expiresAt == null || $this->expiresAt < new \DateTime('now', new \DateTimeZone('UTC'));
    }
}