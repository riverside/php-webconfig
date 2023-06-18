<?php
namespace PhpWebConfig\WebServer\HttpCompression;

use PhpWebConfig\Base;

class DynamicTypes extends Base
{
    public function add()
    {}

    protected function collection()
    {
        return $this->xml->{'system.webServer'}->httpCompression->dynamicTypes;
    }

    public function get()
    {}

    public function has($mimeType, $nodeName=null)
    {}

    public function unmount($mimeType=null, $nodeName=null): bool
    {
        $i = 0;
        foreach ($this->collection()->children() as $node)
        {
            if (($mimeType == null || (string) $node['mimeType'] == $mimeType) && ($nodeName == null || $node->getName() == $nodeName))
            {
                self::removeNode($node);
                $i += 1;
            }
        }

        return $i ? true : false;
    }
}