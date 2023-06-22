<?php
namespace PhpWebConfig\WebServer\HttpCompression;

use PhpWebConfig\Base;

class StaticTypes extends Base
{
    public function add()
    {
        //TODO
    }

    public function get()
    {
        //TODO
    }

    public function has(string $mimeType, string $nodeName=null): bool
    {
        //TODO
    }

    protected function staticTypes(): \SimpleXMLElement
    {
        return $this->xml->{'system.webServer'}->httpCompression->staticTypes;
    }

    public function unmount($mimeType=null, $nodeName=null)
    {
        //TODO
    }
}