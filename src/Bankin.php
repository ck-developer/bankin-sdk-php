<?php

namespace Bankin;

use Bankin\HttpClient\ClientConfigurator;
use Bankin\Hydrator\HydratorInterface;
use Bankin\Hydrator\ModelHydrator;
use Http\Client\Common\PluginClient;
use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;

class Bankin
{
    /**
     * @var PluginClient
     */
    private $httpClient;

    /**
     * @var RequestFactoryInterface
     */
    private $requestFactory;

    /**
     * @var UriFactoryInterface
     */
    private $uriFactory;

    /**
     * @var HydratorInterface
     */
    private $hydrator;

    /**
     * Siren constructor.
     *
     * @param ClientConfigurator $clientConfigurator
     * @param RequestFactoryInterface|null $requestFactory
     * @param UriFactoryInterface|null $uriFactory
     * @param HydratorInterface $hydrator
     */
    public function __construct(
        ClientConfigurator $clientConfigurator,
        RequestFactoryInterface $requestFactory = null,
        UriFactoryInterface $uriFactory = null,
        HydratorInterface $hydrator = null
    ) {
        $this->clientConfigurator = $clientConfigurator;
        $this->httpClient = $clientConfigurator->build();
        $this->requestFactory = $this->requestFactory ?? Psr17FactoryDiscovery::findRequestFactory();
        $this->uriFactory = $this->uriFactory ?? Psr17FactoryDiscovery::findUrlFactory();
        $this->hydrator = $hydrator ?? new ModelHydrator();
    }

    /**
     * @param string $clientId
     * @param string $clientSecret
     *
     * @return self
     */
    static public function create(string $clientId, string $clientSecret): self
    {
        $builder = new ClientConfigurator();
        $builder
            ->setClientId($clientId)
            ->setClientSecret($clientSecret)
        ;

        return new self($builder);
    }

    /**
     * @return self
     */
    public function login($email, $password)
    {
        $AuthenticationApi = new Api\AuthenticationApi($this->httpClient, $this->requestFactory, $this->uriFactory, $this->hydrator);
        $accessToken = $AuthenticationApi->login($email, $password);

        $this->clientConfigurator->setAcessToken($accessToken->getToken());

        $this->httpClient = $this->clientConfigurator->build();

        return $this;
    }

    /**
     * @return self
     */
    public function logout()
    {
        $AuthenticationApi = new Api\AuthenticationApi($this->httpClient, $this->requestFactory, $this->uriFactory, $this->hydrator);
        $AuthenticationApi->logout();

        $this->clientConfigurator->setAcessToken(null);

        $this->httpClient = $this->clientConfigurator->build();

        return $this;
    }

    /**
     * @return Api\BanksApi
     */
    public function banks(): Api\BanksApi
    {
        return new Api\BanksApi($this->httpClient, $this->requestFactory, $this->uriFactory, $this->hydrator);
    }

    /**
     * @return Api\UsersApi
     */
    public function users() : Api\UsersApi
    {
        return new Api\UsersApi($this->httpClient, $this->requestFactory, $this->uriFactory, $this->hydrator);
    }

    /**
     * @return Api\AccountsApi
     */
    public function accounts(): Api\AccountsApi
    {
        return new Api\AccountsApi($this->httpClient, $this->requestFactory, $this->uriFactory, $this->hydrator);
    }

    /**
     * @return Api\ItemsApi
     */
    public function items(): Api\ItemsApi
    {
        return new Api\ItemsApi($this->httpClient, $this->requestFactory, $this->uriFactory, $this->hydrator);
    }

    /**
     * @return Api\TransactionsApi
     */
    public function transactions(): Api\TransactionsApi
    {
        return new Api\TransactionsApi($this->httpClient, $this->requestFactory, $this->uriFactory, $this->hydrator);
    }

    /**
     * @return Api\StocksApi
     */
    public function stocks(): Api\StocksApi
    {
        return new Api\StocksApi($this->httpClient, $this->requestFactory, $this->uriFactory, $this->hydrator);
    }

    /**
     * @return Api\PaginationApi
     */
    public function pagination(): Api\PaginationApi
    {
        return new Api\PaginationApi($this->httpClient, $this->requestFactory, $this->uriFactory, $this->hydrator);
    }
}
