<?php
namespace PhpWebConfig\WebServer;

use PHPUnit\Framework\TestCase;

class CachingTest extends TestCase
{
    public function testSuccess()
    {
        $attributes = array(

        );
        foreach ($attributes as $attribute) {
            $this->assertClassHasAttribute($attribute, Caching::class);
        }
    }
}