<?php
namespace PhpWebConfig\Tests\WebServer;

use PHPUnit\Framework\TestCase;
use PhpWebConfig\Tests\BaseTest;
use PhpWebConfig\WebServer\CustomHeaders;

class CustomHeadersTest extends TestCase
{
    public function testReset()
    {
        $filename = BaseTest::init();

        $ch = new CustomHeaders($filename);

        $this->assertTrue($ch->reset(), 'reset() is expected to return true.');
    }

    public function testHas()
    {
        $filename = BaseTest::init();

        $ch = new CustomHeaders($filename);

        $this->assertTrue($ch->has('X-Frame-Options'), "has('X-Frame-Options') should return true");
    }

    public function testHasNot()
    {
        $filename = BaseTest::init();

        $ch = new CustomHeaders($filename);

        $this->assertFalse($ch->has('X-Some-Header-Name'), "has('X-Some-Header-Name') should return false.");
    }

    public function testAdd()
    {
        $filename = BaseTest::init();

        $ch = new CustomHeaders($filename);

        $this->assertTrue($ch->add('X-My-Header', 'my value'), "add('X-My-Header') should return true.");
    }

    public function testRemove()
    {
        $filename = BaseTest::init();

        $ch = new CustomHeaders($filename);

        $this->assertTrue($ch->remove('X-My-Header'), "remove('X-My-Header') should return true.");
    }

    public function testGet()
    {
        $filename = BaseTest::init();

        $ch = new CustomHeaders($filename);

        $this->assertEquals('SAMEORIGIN', $ch->get('X-Frame-Options', 'add'), "get('X-Frame-Options', 'add') should return SAMEORIGIN.");
    }

    public function testGetFalse()
    {
        $filename = BaseTest::init();

        $ch = new CustomHeaders($filename);

        $this->expectException(\Exception::class);

        $ch->get('X-My-Header', 'add');
    }
}