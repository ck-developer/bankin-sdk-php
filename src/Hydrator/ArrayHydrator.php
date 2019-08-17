<?php

namespace Bankin\Hydrator;

use Psr\Http\Message\ResponseInterface;

class ArrayHydrator implements HydratorInterface
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
        if (0 !== strpos($response->getHeaderLine('content-type'), 'application/json')) {
            throw new \Exception('The ArrayHydrator cannot hydrate response with Content-Type:'.$response->getHeaderLine('Content-Type'));
        }

        $body = $response->getBody()->getContents();

        $content = \json_decode($body, true);

        if (JSON_ERROR_NONE !== \json_last_error()) {
            throw new \Exception(sprintf('Error (%d) when trying to json_decode response', \json_last_error()));
        }

        return $content;
    }
}
