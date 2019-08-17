<?php

namespace Bankin\Tests;

use Bankin\Api\BanksApi;
use Bankin\Api\UsersApi;
use Bankin\Api\PaginationApi;
use PHPUnit\Framework\TestCase;
use Bankin\Bankin;

class BankinTest extends TestCase
{
    /**
     * @var Bankin
     */
    private $bankin;

    public function setUp()
    {
        $this->bankin = Bankin::create('client_id', 'client_secret');
    }

    public function testBanks()
    {
        $this->assertInstanceOf(BanksApi::class, $this->bankin->banks());
    }

    public function testUsers()
    {
        $this->assertInstanceOf(UsersApi::class, $this->bankin->users());
    }

    public function testPagination()
    {
        $this->assertInstanceOf(PaginationApi::class, $this->bankin->pagination());
    }
}
