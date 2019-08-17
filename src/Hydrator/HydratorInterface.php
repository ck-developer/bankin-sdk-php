<?php

namespace Bankin\Hydrator;

use Psr\Http\Message\ResponseInterface;

interface HydratorInterface
{
    /**
     * @param ResponseInterface $response
     * @param string $class
     *
     * @return mixed
     */
    public function hydrate(ResponseInterface $response, string $class);
}
