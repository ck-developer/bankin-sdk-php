<?php

namespace Bankin\Api;

use Bankin\Model\Account;
use Bankin\Model\Accounts;

/**
 * Class AccountsApi
 */
class AccountsApi extends AbstractApi
{
    /**
     * @param \DateTimeInterface $until
     * @param int $limit
     *
     * @return Accounts|array
     *
     * @throws \Http\Client\Exception
     * @throws \Exception
     */
    public function list(int $limit = 20)
    {
        $response = $this->sendRequest('GET', '/accounts', [
            'query' => [
                'limit' => $limit
            ]
        ]);

        return $this->hydrate($response, Accounts::class);
    }

    /**
     * @param int $id
     *
     * @return Account|array
     *
     * @throws \Http\Client\Exception
     */
    public function get(int $id)
    {
        $response = $this->sendRequest('GET', "/accounts/$id");

        return $this->hydrate($response, Account::class);
    }
}
