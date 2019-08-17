<?php

namespace Bankin\Tests\Hydrator;

use Bankin\Hydrator\ArrayHydrator;
use PHPUnit\Framework\TestCase;

class ArrayHydratorTest extends TestCase
{
    /**
     * @var ArrayHydrator
     */
    private $hydrator;

    public function setUp()
    {
        $this->hydrator = new ArrayHydrator();
    }

    /**
     * @dataProvider getDataHydratorSuccess
     *
     * @param array $response
     * @param array $expected
     *
     * @throws \Exception
     */
    public function testHydrateSuccess(array $response, array $expected)
    {
        $response = $this->mockResponseFromArray($response);

        $this->assertSame($expected, $this->hydrator->hydrate($response));
    }

    /**
     * @dataProvider getDataHydratorWithException
     *
     * @param array $response
     * @param string $exceptionClass
     *
     * @throws \Exception
     */
    public function testHydrateWithException(array $response, string $exceptionClass)
    {
        $response = $this->mockResponseFromArray($response);

        $this->expectException($exceptionClass);

        $this->hydrator->hydrate($response);
    }

    /**
     * @return array
     */
    public function getDataHydratorSuccess()
    {
        return [
            [
                [
                    'headers' => [
                        'content-type' => 'application/json'
                    ],
                    'body' => '{"uuid": "ced7c68a-6692-4efe-882b-c03a787f118b","email": "john@doe.com"}'
                ],
                [
                    'uuid' => 'ced7c68a-6692-4efe-882b-c03a787f118b',
                    'email' => 'john@doe.com',
                ]
            ],
        ];
    }

    /**
     * @return array
     */
    public function getDataHydratorWithException()
    {
        return [
            [
                [
                    'body' => '{"uuid": "ced7c68a-6692-4efe-882b-c03a787f118b","email": "john@doe.com"}'
                ],
                \Exception::class
            ],
            [
                [
                    'headers' => [
                        'content-type' => 'application/json'
                    ],
                    'body' => '{uuid: "ced7c68a-6692-4efe-882b-c03a787f118b", email: "john@doe.com"}'
                ],
                \Exception::class
            ],
        ];
    }

    /**
     * @param array $response
     *
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    private function mockResponseFromArray(array $response)
    {
        $mockedResponse = $this->getMockBuilder('Psr\Http\Message\ResponseInterface')->getMock();
        $mockedStream = $this->getMockBuilder('Psr\Http\Message\StreamInterface')->getMock();

        if (isset($response['body'])) {
            $mockedStream
                ->expects($this->any())
                ->method('__toString')
                ->willReturn($response['body']);

            $mockedStream
                ->expects($this->any())
                ->method('getContents')
                ->willReturn($response['body']);

            $mockedResponse
                ->expects($this->any())
                ->method('getBody')
                ->willReturn($mockedStream);
        }

        if (isset($response['headers'])) {
            $mockedResponse
                ->expects($this->any())
                ->method('getHeaderLine')
                ->willReturnMap(array_map(function ($header, $value) { return [$header, $value]; }, array_keys($response['headers']), $response['headers']))
            ;
        }

        return $mockedResponse;
    }
}