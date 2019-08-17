<?php

namespace Bankin\Api;

use Bankin\Model\AccessToken;
use Bankin\Model\Result;
use Bankin\Model\User;
use Bankin\Model\Users;

class AuthenticationApi extends AbstractApi
{
    /**
     * @var AccessToken
     */
    private $accessToken;

    /**
     * @param string $email
     * @param string $password
     *
     * @return AccessToken|array|mixed
     *
     * @throws \Http\Client\Exception
     */
    public function login(string $email, string $password)
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
     * @return bool
     *
     * @throws \Http\Client\Exception
     */
    public function logout()
    {
        $response = $this->sendRequest('POST', '/logout');

        return true;
    }
}
