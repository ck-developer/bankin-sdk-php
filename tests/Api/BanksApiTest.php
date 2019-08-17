<?php

namespace Bankin\Tests\Api;

use Bankin\Api\BanksApi;
use Bankin\Hydrator\ModelHydrator;
use Bankin\Model\Bank;
use Bankin\Model\BankGroups;
use Http\Client\Common\PluginClient;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Mock\Client;

class BanksApiTest extends ApiTestCase
{
    public function testAll()
    {
        $client = new Client();
        $response = $this->mockResponse(__DIR__ . '/../../mocks/banks/list/listed.txt');
        $client->addResponse($response);
        $pluginClient = new PluginClient($client);

        $api = new BanksApi($pluginClient, Psr17FactoryDiscovery::findRequestFactory(), Psr17FactoryDiscovery::findUrlFactory(), new ModelHydrator());

        /** @var BankGroups $groups */
        $groups = $api->all();

        $group = $groups->first();

        $this->assertEquals('Hypovereinsbank (HVB)', $group->getName());
        $this->assertEquals('https://web.bankin.com/img/banks-logo/germany/06_hbv@2x.png', $group->getLogoUrl());
        $this->assertEquals('DE', $group->getCountryCode());
        $this->assertTrue(is_array($group->getBanks()));

        foreach ($group->getBanks() as $bank)
        {
            $this->assertInstanceOf(Bank::class, $bank);
        }
    }

    public function testGet()
    {
        $client = new Client();
        $response = $this->mockResponse(__DIR__ . '/../../mocks/banks/get/success.txt');
        $client->addResponse($response);
        $pluginClient = new PluginClient($client);

        $api = new BanksApi($pluginClient, Psr17FactoryDiscovery::findRequestFactory(), Psr17FactoryDiscovery::findUrlFactory(), new ModelHydrator());

        $bank = $api->get(64);

        $this->assertInstanceOf(Bank::class, $bank);
        $this->assertEquals(64, $bank->getId());
        $this->assertEquals('Crédit Agricole Languedoc', $bank->getName());
        $this->assertEquals('FR', $bank->getCountryCode());
        $this->assertTrue(is_array($bank->getForm()));
        $this->assertEquals(true, $bank->isAutomaticRefresh());
    }
}
