<?php

namespace Bankin\Hydrator;

use Bankin\Pagination\PageableInterface;
use Psr\Http\Message\ResponseInterface;

class ModelHydrator extends ArrayHydrator
{
    /**
     * @param ResponseInterface $response
     * @param string|null $class

     * @return array
     *
     * @throws \Exception
     */
    public function hydrate(ResponseInterface $response, string $class = null)
    {
        $data = parent::hydrate($response);

        return new $class($data);
    }
}
