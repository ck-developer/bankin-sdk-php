<?php

namespace Bankin\Api;

use Bankin\Model\Bank;
use Bankin\Model\BankGroups;

class BanksApi extends AbstractApi
{
    /**
     * @param int $limit
     *
     * @return BankGroups|array
     *
     * @throws \Http\Client\Exception
     *
     * @throws \Exception
     */
    public function list(int $limit = 100)
    {
        $response = $this->sendRequest('GET', '/banks', [
            'query' => [
                'limit' => $limit
            ]
        ]);

        return $this->hydrate($response, BankGroups::class);
    }

    /**
     * @param int $id
     *
     * @return array|Bank
     *
     * @throws \Http\Client\Exception
     */
    public function get(int $id)
    {
        $response = $this->sendRequest('GET', "/banks/$id");

        return $this->hydrate($response, Bank::class);
    }
}
