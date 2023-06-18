<?php
namespace PhpWebConfig\WebServer;

use PHPUnit\Framework\TestCase;

class CustomHeadersTest extends TestCase
{
    public function testSuccess()
    {
        $attributes = array(

        );
        foreach ($attributes as $attribute) {
            $this->assertClassHasAttribute($attribute, CustomHeaders::class);
        }
    }
}