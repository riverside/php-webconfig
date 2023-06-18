<?php
namespace PhpWebConfig;

use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{
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

    public function testDOMDocument()
    {
        $this->assertTrue(extension_loaded('dom'), 'ext-dom is missing');
    }

    public function testSimpleXML()
    {
        $this->assertTrue(extension_loaded('simplexml'), 'ext-simplexml is missing');
    }
}