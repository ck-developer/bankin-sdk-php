<?php

namespace Bankin\Model;

abstract class Resource
{
    /**
     * @var string
     */
    private $resourceType;

    /**
     * @var string
     */
    private $resourceUri;

    /**
     * Resource constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->resourceType = $data['resource_type'] ?? null;
        $this->resourceUri = $data['resource_uri'] ?? null;
    }

    /**
     * @return string
     */
    public function getResourceType(): string
    {
        return $this->resourceType;
    }

    /**
     * @return string
     */
    public function getResourceUri(): string
    {
        return $this->resourceUri;
    }
}