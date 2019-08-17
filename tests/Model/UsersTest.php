<?php

namespace Bankin\Tests\Model;

use Bankin\Model\Pagination;
use Bankin\Model\Users;
use PHPUnit\Framework\TestCase;

class UsersTest extends TestCase
{
    public function testFromArray()
    {
        $users = new Users([
            'resources' => [
                [
                    'uuid' => 'ced7c68a-6692-4efe-882b-c03a787f118b',
                    'resource_uri' => '/v2/users/ced7c68a-6692-4efe-882b-c03a787f118b',
                    'resource_type' => 'user',
                    'email' => 'john@doe.com',
                ],
            ],
            'pagination' => [
                'previous_uri' => NULL,
                'next_uri' => '/v2/users?after=Y2VkN2M2OGEtNjY5Mi00ZWZlLTg4MmItYzAzYTc4N2YxMThi&limit=1',
            ],
        ]);

        $this->assertSame(true, $users->hasNext());
        $this->assertSame('/v2/users?after=Y2VkN2M2OGEtNjY5Mi00ZWZlLTg4MmItYzAzYTc4N2YxMThi&limit=1', $users->getNext());
        $this->assertSame(false, $users->hasPrevious());
        $this->assertSame(null, $users->getPrevious());
        $this->assertSame(Users::class, $users->getClass());
    }
}