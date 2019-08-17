<?php

namespace Bankin\HttpClient;

use Http\Client\Common\Plugin;
use Http\Client\Common\PluginClient;
use Http\Client\Common\PluginClientFactory;
use Http\Client\HttpAsyncClient;
use Http\Discovery\HttpAsyncClientDiscovery;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Message\Authentication\Bearer;
use Psr\Http\Message\UriFactoryInterface;

class ClientConfigurator
{
    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * @var string|null
     */
    private $acessToken;

    /**
     * @var HttpAsyncClient
     */
    private $httpAdapter;

    /**
     * @var UriFactoryInterface
     */
    private $urlFactory;

    /**
     * @var Plugin[]
     */
    private $plugins;

    /**
     * @param string $clientId
     *
     * @return self
     */
    public function setClientId(string $clientId): self
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * @param string $clientSecret
     *
     * @return self
     */
    public function setClientSecret(string $clientSecret): self
    {
        $this->clientSecret = $clientSecret;

        return $this;
    }

    /**
     * @param string|null $acessToken
     *
     * @return self
     */
    public function setAcessToken(?string $acessToken): self
    {
        $this->acessToken = $acessToken;

        return $this;
    }

    /**
     * @param HttpAsyncClient $httpAdapter
     *
     * @return self
     */
    public function setHttpClient(HttpAsyncClient $httpAdapter): self
    {
        $this->httpAdapter = $httpAdapter;

        return $this;
    }

    /**
     * @param Plugin $plugin
     *
     * @return self
     */
    public function addPlugin(Plugin $plugin): self
    {
        $this->plugins[get_class($plugin)] = $plugin;

        return $this;
    }

    /**
     * @return PluginClient
     */
    public function build(): PluginClient
    {
        $this->plugins = [];
        $this->httpAdapter = $this->httpAdapter ?? HttpAsyncClientDiscovery::find();
        $this->urlFactory = $this->urlFactory ?? Psr17FactoryDiscovery::findUrlFactory();

        $this
            ->addPlugin(
                new Plugin\BaseUriPlugin($this->urlFactory->createUri('https://sync.bankin.com/v2'))
            )
            ->addPlugin(
                new Plugin\HeaderDefaultsPlugin(array(
                    'Bankin-Version' => '2018-06-15',
                    'User-Agent' => 'bankin-sdk-php (https://github.com/ck-developer/bankin-sdk-php)',
                ))
            )
            ->addPlugin(
                new Plugin\ContentLengthPlugin()
            )
            ->addPlugin(
                new Plugin\QueryDefaultsPlugin([
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret
                ])
            )
        ;

        if ($this->acessToken !== null) {
            $this->addPlugin(new Plugin\AuthenticationPlugin(
                new Bearer($this->acessToken)
            ));
        }

        return (new PluginClientFactory())->createClient(
            $this->httpAdapter,
            $this->plugins,
            ['client_name' => 'Bankin']
        );
    }
}