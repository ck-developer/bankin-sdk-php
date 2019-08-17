<?php

namespace Bankin\Tests\Model;

use Bankin\Model\AccessToken;
use Bankin\Model\User;
use PHPUnit\Framework\TestCase;

class AccessTokenTest extends TestCase
{
    public function testConstruct()
    {
        $accessToken = new AccessToken([
            'user' => [
                [
                    'uuid' => 'c2a26c9e-dc23-4f67-b887-bbae0f26c415',
                    'email' => 'john.doe@email.com',
                    'resource_uri' => '/v2/users/c2a26c9e-dc23-4f67-b887-bbae0f26c415',
                    'resource_type' => 'user',
                ],
            ],
            'access_token' => '080eb175ff646b5ac319767dff639d9994ed1f7a-66a220bb-be01-476f-ae7c-1b0b96577c05',
            'expires_at' => '2016-05-06T11:08:25.040Z',
        ]);

        $this->assertInstanceOf(User::class, $accessToken->getUser());
        $this->assertEquals('080eb175ff646b5ac319767dff639d9994ed1f7a-66a220bb-be01-476f-ae7c-1b0b96577c05', $accessToken->getToken());
        $this->assertEquals(new \DateTimeImmutable('2016-05-06T11:08:25.040Z'), $accessToken->getExpiresAt());
    }
}