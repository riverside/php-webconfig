<?php
namespace PhpWebConfig\Tests\WebServer;

use PHPUnit\Framework\TestCase;
use PhpWebConfig\Tests\BaseTest;
use PhpWebConfig\WebServer\HttpCompression;

class HttpCompressionTest extends TestCase
{
    public function testAddDynamic()
    {
        $filename = BaseTest::init();

        $hc = new HttpCompression($filename);

        $this->assertTrue($hc->addDynamic('application/javascript'), 'addDynamic() should return true');
    }

    public function testAddStatic()
    {
        $filename = BaseTest::init();

        $hc = new HttpCompression($filename);

        $this->assertTrue($hc->addStatic('application/javascript'), 'addStatic() should return true');
    }

    public function testHasDynamic()
    {
        $filename = BaseTest::init();

        $hc = new HttpCompression($filename);

        $this->assertTrue($hc->hasDynamic('application/javascript'), 'hasDynamic() should return true');
    }

    public function testHasStatic()
    {
        $filename = BaseTest::init();

        $hc = new HttpCompression($filename);

        $this->assertTrue($hc->hasStatic('application/javascript'), 'hasStatic() should return true');
    }

    public function testGetDynamic()
    {
        $filename = BaseTest::init();

        $hc = new HttpCompression($filename);

        $this->assertNotEmpty($hc->getDynamic('application/javascript', 'add'), 'getDynamic() should return true');
    }

    public function testGetStatic()
    {
        $filename = BaseTest::init();

        $hc = new HttpCompression($filename);

        $this->assertNotEmpty($hc->getStatic('application/javascript', 'add'), 'getStatic() should return true');
    }

    public function testUnmountDynamic()
    {
        $filename = BaseTest::init();

        $hc = new HttpCompression($filename);

        $this->assertTrue($hc->unmountDynamic('application/javascript'), 'unmountDynamic() should return true');
    }

    public function testUnmountStatic()
    {
        $filename = BaseTest::init();

        $hc = new HttpCompression($filename);

        $this->assertTrue($hc->unmountStatic('application/javascript'), 'unmountStatic() should return true');
    }
}