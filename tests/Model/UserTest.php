<?php

namespace Bankin\Tests\Model;

use Bankin\Model\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testFromArray()
    {
        $user = new User([
            'uuid' => 'ced7c68a-6692-4efe-882b-c03a787f118b',
            'email' => 'john@doe.com',
            'resource_uri' => '/v2/users/ced7c68a-6692-4efe-882b-c03a787f118b',
            'resource_type' => 'user',
        ]);

        $this->assertSame('ced7c68a-6692-4efe-882b-c03a787f118b', $user->getUuid());
        $this->assertSame('john@doe.com', $user->getEmail());
        $this->assertSame('user', $user->getResourceType());
        $this->assertSame('/v2/users/ced7c68a-6692-4efe-882b-c03a787f118b', $user->getResourceUri());
    }
}