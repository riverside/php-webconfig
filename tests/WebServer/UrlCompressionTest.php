<?php
namespace PhpWebConfig\Tests\WebServer;

use PHPUnit\Framework\TestCase;
use PhpWebConfig\Tests\BaseTest;
use PhpWebConfig\WebServer\UrlCompression;

class UrlCompressionTest extends TestCase
{
    public function testDisableDynamic()
    {
        $filename = BaseTest::init();

        $uc = new UrlCompression($filename);

        $this->assertTrue($uc->disableDynamic(), 'disableDynamic() should return true');
        $this->assertTrue($uc->getXml()->{'system.webServer'}->urlCompression['doDynamicCompression'] == 'false', 'doDynamicCompression is not false');
    }

    public function testDisableStatic()
    {
        $filename = BaseTest::init();

        $uc = new UrlCompression($filename);

        $this->assertTrue($uc->disableStatic(), 'disableStatic() should return true');
        $this->assertTrue($uc->getXml()->{'system.webServer'}->urlCompression['doStaticCompression'] == 'false', 'doStaticCompression is not false');
    }

    public function testDisableDynamicBeforeCache()
    {
        $filename = BaseTest::init();

        $uc = new UrlCompression($filename);

        $this->assertTrue($uc->disableDynamicBeforeCache(), 'disableDynamicBeforeCache() should return true');
        $this->assertTrue($uc->getXml()->{'system.webServer'}->urlCompression['dynamicCompressionBeforeCache'] == 'false', 'dynamicCompressionBeforeCache is not false');
    }

    public function testEnableDynamic()
    {
        $filename = BaseTest::init();

        $uc = new UrlCompression($filename);

        $this->assertTrue($uc->enableDynamic(), 'enableDynamic() should return true');
        $this->assertTrue($uc->getXml()->{'system.webServer'}->urlCompression['doDynamicCompression'] == 'true', 'doDynamicCompression is not true');
    }

    public function testEnableStatic()
    {
        $filename = BaseTest::init();

        $uc = new UrlCompression($filename);

        $this->assertTrue($uc->enableStatic(), 'enableStatic() should return true');
        $this->assertTrue($uc->getXml()->{'system.webServer'}->urlCompression['doStaticCompression'] == 'true', 'doStaticCompression is not true');
    }

    public function testEnableDynamicBeforeCache()
    {
        $filename = BaseTest::init();

        $uc = new UrlCompression($filename);

        $this->assertTrue($uc->enableDynamicBeforeCache(), 'enableDynamicBeforeCache() should return true');
        $this->assertTrue($uc->getXml()->{'system.webServer'}->urlCompression['dynamicCompressionBeforeCache'] == 'true', 'dynamicCompressionBeforeCache is not true');
    }
}