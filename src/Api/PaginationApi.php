<?php

namespace Bankin\Api;

use Bankin\Model\Resources;

class PaginationApi extends AbstractApi
{
    /**
     * @param string $uri
     * @param string|null $class
     *
     * @return array|mixed
     *
     * @throws \Http\Client\Exception
     */
    public function getNextWithUri(string $uri, string $class = null)
    {
        $response = $this->sendRequest('GET', $uri);

        return $this->hydrate($response, $class);
    }

    /**
     * @param string $uri
     * @param string|null $class
     *
     * @return array|mixed
     *
     * @throws \Http\Client\Exception
     */
    public function getPreviousWithUri(string $uri, string $class = null)
    {
        $response = $this->sendRequest('GET', $uri);

        return $this->hydrate($response, $class);
    }

    /**
     * @param Resources $resources
     *
     * @return mixed
     *
     * @throws \Http\Client\Exception
     */
    public function getNext(Resources $resources)
    {
        return $this->getNextWithUri($resources->getPagination()->getNext(), $resources->getClass());
    }

    /**
     * @param Resources $resources
     *
     * @return Resources|array
     *
     * @throws \Http\Client\Exception
     */
    public function getPrevious(Resources $resources)
    {
        return  $this->getPreviousWithUri($resources->getPagination()->getPrevious(), $resources->getClass());
    }
}
