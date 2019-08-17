<?php

namespace Bankin\Api;

use Bankin\Model\AccessToken;
use Bankin\Model\Result;
use Bankin\Model\User;
use Bankin\Model\Users;

class UsersApi extends AbstractApi
{
    /**
     * @param string $email
     * @param string $password
     *
     * @return User|array|mixed
     *
     * @throws \Http\Client\Exception
     * @throws \Exception
     */
    public function create(string $email, string $password)
    {
        $response = $this->sendRequest('POST', '/users', [
            'query' => [
                'email' => $email,
                'password' => $password
            ]
        ]);

        return $this->hydrate($response, User::class);
    }

    /**
     * @param string $email
     * @param string $password
     *
     * @return AccessToken|array|mixed
     *
     * @throws \Http\Client\Exception
     */
    public function authenticate(string $email, string $password)
    {
        $response = $this->sendRequest('POST', '/authenticate', [
            'query' => [
                'email' => $email,
                'password' => $password
            ]
        ]);

        return $this->hydrate($response, AccessToken::class);
    }

    /**
     * @param int $limit
     *
     * @return Users|array
     *
     * @throws \Http\Client\Exception
     *
     * @throws \Exception
     */
    public function all(int $limit = 100)
    {
        $response = $this->sendRequest('GET', '/users', [
            'query' => [
                'limit' => $limit
            ]
        ]);

        return $this->hydrate($response, Users::class);
    }

    /**
     * @param string $uuid
     * @param string $password
     * @return bool
     *
     * @throws \Http\Client\Exception
     */
    public function delete(string $uuid, string $password)
    {
        $response = $this->sendRequest('DELETE', '/users/{uuid}', [
            'params' => [
                'uuid' => $uuid
            ],
            'query' => [
                'password' => $password
            ]
        ]);

        return $response->getStatusCode() == 204;
    }
}
