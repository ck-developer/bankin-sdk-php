<?php

namespace Bankin\Api;

use Bankin\Model\Transactions;

/**
 * Class StocksApi
 */
class StocksApi extends AbstractApi
{
    /**
     * @param \DateTimeInterface $until
     * @param int $limit
     *
     * @return Transactions|array
     *
     * @throws \Http\Client\Exception
     * @throws \Exception
     */
    public function list(\DateTimeInterface $until, int $limit = 20)
    {
        $response = $this->sendRequest('GET', '/stocks', [
            'query' => [
                'until' => $until->format('YYYY-MM-DD'),
                'limit' => $limit
            ]
        ]);

        return $this->hydrate($response, Transactions::class);
    }

    /**
     * @param int $id
     *
     * @return Transaction|array
     *
     * @throws \Http\Client\Exception
     */
    public function get(int $id)
    {
        $response = $this->sendRequest('GET', "/transactions/$id");

        return $this->hydrate($response, Transaction::class);
    }
}
