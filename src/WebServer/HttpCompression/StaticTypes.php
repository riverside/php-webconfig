<?php
namespace PhpWebConfig\WebServer\HttpCompression;

use PhpWebConfig\Base;

class StaticTypes extends Base
{
    public function add()
    {}

    public function get()
    {}

    public function has($mimeType, $nodeName=null)
    {}

    protected function staticTypes()
    {
        return $this->xml->{'system.webServer'}->httpCompression->staticTypes;
    }

    public function unmount($mimeType=null, $nodeName=null)
    {}
}