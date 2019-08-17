<?php

namespace Bankin\Model;

class Pagination
{
    /**
     * @var string
     */
    private $previous;

    /**
     * @var string
     */
    private $next;

    /**
     * Pagination constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->previous = $data['previous_uri'] ?? null;
        $this->next = $data['next_uri'] ?? null;
    }

    /**
     * @return bool
     */
    public function hasPrevious(): bool
    {
        return $this->previous !== null;
    }

    /**
     * @return string|null
     */
    public function getPrevious(): ?string
    {
        return $this->previous;
    }

    /**
     * @return bool
     */
    public function hasNext(): bool
    {
        return $this->next !== null;
    }

    /**
     * @return string|null
     */
    public function getNext(): ?string
    {
        return $this->next;
    }
}
