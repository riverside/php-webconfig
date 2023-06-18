<?php
namespace PhpWebConfig\Tests\WebServer;

use PHPUnit\Framework\TestCase;
use PhpWebConfig\Tests\BaseTest;
use PhpWebConfig\WebServer\Caching;

class CachingTest extends TestCase
{
    public function testReset()
    {
        $filename = BaseTest::init();

        $caching = new Caching($filename);

        $this->assertIsBool($caching->reset(), 'reset() should return boolean');
    }

    public function testHas()
    {
        $filename = BaseTest::init();

        $caching = new Caching($filename);

        $this->assertTrue($caching->has('.asp', 'add'), "has('.asp', 'add') should return true");
    }

    public function testHasNot()
    {
        $filename = BaseTest::init();

        $caching = new Caching($filename);

        $this->assertFalse($caching->has('.php', 'add'), "has('.php', 'add') should return false");
    }

    public function testAdd()
    {
        $filename = BaseTest::init();

        $caching = new Caching($filename);

        $this->assertTrue($caching->add('.php'), "add('.php') should return true");
    }

    public function testRemove()
    {
        $filename = BaseTest::init();

        $caching = new Caching($filename);

        $this->assertTrue($caching->remove('.asp'), "remove('.asp') should return true");
    }

    public function testClear()
    {
        $filename = BaseTest::init();

        $caching = new Caching($filename);

        $this->assertTrue($caching->clear(), "clear() should return true");
    }
}