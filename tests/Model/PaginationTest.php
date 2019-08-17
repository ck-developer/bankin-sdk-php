<?php

namespace Bankin\Tests\Model;

use Bankin\Model\Pagination;
use Bankin\Model\Users;
use PHPUnit\Framework\TestCase;

class PaginationTest extends TestCase
{
    /**
     * @dataProvider getPaginationData
     *
     * @param array $expected
     */
    public function testConstruct(array $expected)
    {
        $pagination = new Pagination($expected);

        $this->assertSame(isset($expected['previous_uri']) ? true : false, $pagination->hasPrevious());
        $this->assertSame($expected['previous_uri'] ?? null, $pagination->getPrevious());
        $this->assertSame(isset($expected['next_uri']) ? true : false, $pagination->hasNext());
        $this->assertSame($expected['next_uri'] ?? null, $pagination->getNext());
    }

    public function getPaginationData()
    {
        return [
            [
                [
                    'previous_uri' => null,
                    'next_uri' => '/v2/users?after=Y2VkN2M2OGEtNjY5Mi00ZWZlLTg4MmItYzAzYTc4N2YxMThi&limit=1',
                ],
            ],
            [
                [
                    'previous_uri' => '/v2/users?after=Y2VkN2M2OGEtNjY5Mi00ZWZlLTg4MmItYzAzYTc4N2YxMThi&limit=1',
                    'next_uri' => null,
                ],
            ],
        ];
    }
}