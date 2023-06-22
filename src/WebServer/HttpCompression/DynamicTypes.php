<?php
namespace PhpWebConfig\WebServer\HttpCompression;

use PhpWebConfig\Base;

class DynamicTypes extends Base
{
    public function add()
    {
        //TODO
    }

    protected function collection(): \SimpleXMLElement
    {
        return $this->xml->{'system.webServer'}->httpCompression->dynamicTypes;
    }

    public function get()
    {
        //TODO
    }

    public function has(string $mimeType, string $nodeName=null): bool
    {
        //TODO
    }

    public function unmount(string $mimeType=null, string $nodeName=null): bool
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