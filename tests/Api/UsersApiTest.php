<?php

namespace Bankin\Tests\Api;

use Bankin\Api\UsersApi;
use Bankin\Hydrator\ModelHydrator;
use Bankin\Model\User;
use Http\Client\Common\PluginClient;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Mock\Client;

class UsersApiTest extends ApiTestCase
{
    public function testCreate()
    {
        $client = new Client();
        $response = $this->mockResponse(__DIR__ . '/../../mocks/users/create/created.txt');
        $client->addResponse($response);
        $pluginClient = new PluginClient($client);

        $api = new UsersApi($pluginClient, Psr17FactoryDiscovery::findRequestFactory(), Psr17FactoryDiscovery::findUrlFactory(), new ModelHydrator());

        $user = $api->create('john.doe@email.com', 'password');

        $userExcept = new User([
            'uuid' => '43f9d130-d560-4886-9c61-2bcc688c089b',
            'email' => 'john.doe@email.com',
            'resource_type' => 'user',
            'resource_uri' => '/v2/users/43f9d130-d560-4886-9c61-2bcc688c089b',
        ]);

        $this->assertEquals($userExcept, $user);
    }

    public function testDelete()
    {
        $client = new Client();
        $response = $this->mockResponse(__DIR__ . '/../../mocks/users/delete/deleted.txt');
        $client->addResponse($response);
        $pluginClient = new PluginClient($client);

        $api = new UsersApi($pluginClient, Psr17FactoryDiscovery::findRequestFactory(), Psr17FactoryDiscovery::findUrlFactory(), new ModelHydrator());

        $deleted = $api->delete('dec28c17-6bb1-4a8f-9239-ba1823724d8d', 'password');

        $this->assertEquals(true, $deleted);
    }
}
