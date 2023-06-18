<?php
namespace PhpWebConfig\Tests;

use PHPUnit\Framework\TestCase;
use PhpWebConfig\Base;

class BaseTest extends TestCase
{
    public static $xml = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<configuration>
  <system.webServer>
    <httpProtocol allowKeepAlive="true">
      <customHeaders>
        <add name="X-Custom-Header" value="456"/>
        <add name="X-Frame-Options" value="SAMEORIGIN"/>
        <remove name="Via"/>
        <remove name="X-Vevs"/>
      </customHeaders>
    </httpProtocol>
    <httpCompression>
      <scheme name="gzip" dll="%Windir%\System32\inetsrv\gzip.dll"/>
      <dynamicTypes>
        <add mimeType="application/javascript" enabled="true"/>
        <add mimeType="text/css" enabled="true"/>
        <add mimeType="application/json" enabled="false"/>
      </dynamicTypes>
      <staticTypes>
        <add mimeType="application/javascript" enabled="true"/>
        <add mimeType="image/x+svg" enabled="true"/>
      </staticTypes>
    </httpCompression>
    <urlCompression doDynamicCompression="true" dynamicCompressionBeforeCache="true" doStaticCompression="true"/>
    <caching enabled="true" enableKernelCache="false" maxCacheSize="358" maxResponseSize="1234">
      <profiles>
        <add extension=".asp" policy="CacheUntilChange" kernelCachePolicy="CacheUntilChange" />
      </profiles>
    </caching>
  </system.webServer>
</configuration>
XML;

    public static function init()
    {
        $filename = tempnam(sys_get_temp_dir(), 'Tux');
        file_put_contents($filename, self::$xml, LOCK_EX);

        return $filename;
    }

    public function testSuccess()
    {
        $attributes = array(
            'filename',
            'xml',
        );
        foreach ($attributes as $attribute) {
            $this->assertClassHasAttribute($attribute, Base::class);
        }
    }

    public function testSave()
    {
        $filename = self::init();

        $base = new Base($filename);

        $this->assertTrue($base->save(), 'save() should return boolean');
    }

    public function testToString()
    {
        $filename = self::init();

        $base = new Base($filename);

        $this->assertNotEmpty($base->toString(), 'toString() should return a string');
    }

    public function testGetXml()
    {
        $filename = self::init();

        $base = new Base($filename);

        $this->assertInstanceOf(\SimpleXMLElement::class, $base->getXml(), 'getXml() should return SimpleXMLElement');
    }

    public function testDOMDocument()
    {
        $this->assertTrue(extension_loaded('dom'), 'ext-dom is missing');
    }

    public function testSimpleXML()
    {
        $this->assertTrue(extension_loaded('simplexml'), 'ext-simplexml is missing');
    }
}