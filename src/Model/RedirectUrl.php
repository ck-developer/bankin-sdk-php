<?php

namespace Bankin\Model;

class RedirectUrl
{
    /**
     * @var string|null
     */
    private $url;

    /**
     * RedirectUrl constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->url = $data['redirect_url'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }
}