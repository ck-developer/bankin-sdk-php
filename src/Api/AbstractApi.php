<?php

namespace Bankin\Api;

use Bankin\Hydrator\ArrayHydrator;
use Bankin\Hydrator\HydratorInterface;
use Http\Client\Common\PluginClient;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;

abstract class AbstractApi
{
    /**
     * @var PluginClient
     */
    private $httpClient;

    /**
     * @var RequestFactoryInterface|null
     */
    private $requestFactory;

    /**
     * @var UriFactoryInterface|null
     */
    private $uriFactory;

    /**
     * @var ArrayHydrator|HydratorInterface
     */
    private $hydrator;

    /**
     * Siren constructor.
     *
     * @param PluginClient $httpClient
     * @param RequestFactoryInterface $requestFactory
     * @param UriFactoryInterface $uriFactory
     * @param HydratorInterface $hydrator
     */
    public function __construct(
        PluginClient $httpClient,
        RequestFactoryInterface $requestFactory,
        UriFactoryInterface $uriFactory,
        HydratorInterface $hydrator
    ) {
        $this->httpClient = $httpClient;
        $this->requestFactory = $requestFactory;
        $this->uriFactory = $uriFactory;
        $this->hydrator = $hydrator;
    }

    /**
     * @param string $method
     * @param string|UriInterface $uri
     * @param array $options
     *
     * @return ResponseInterface
     *
     * @throws \Http\Client\Exception
     */
    protected function sendRequest(string $method, $uri, array $options = [])
    {
        if (isset($options['params']) && is_array($options['params'])) {
            $uri = str_replace(
                array_map(
                    function ($name) { return sprintf('{%s}', $name); },
                    array_keys($options['params'])
                ),
                array_values($options['params']),
                $uri
            );

        }

        $uri = $this->uriFactory->createUri($uri);

        if (isset($options['query']) && empty($options['query']) == false) {
            $uri = $uri->withQuery(\http_build_query($options['query']));
        }

        $request = $this->requestFactory->createRequest($method, $uri);

        if (isset($options['headers'])) {
            foreach ($options['headers'] as $name => $value) {
                $request->withHeader($name, $value);
            }
        }

        return $this->httpClient->sendRequest($request);
    }

    /**
     * @param ResponseInterface $response
     * @param string $class
     *
     * @return mixed
     *
     * @throws \Exception
     */
    protected function hydrate(ResponseInterface $response, string $class = null)
    {
        return $this->hydrator->hydrate($response, $class);
    }
}
