<?php
namespace PhpWebConfig\WebServer;

use PhpWebConfig\Base;

class UrlCompression extends Base
{
    public function disableDynamic()
    {
        return $this->set('doDynamicCompression', 'false');
    }

    public function disableStatic()
    {
        return $this->set('doStaticCompression', 'false');
    }

    public function disableDynamicBeforeCache()
    {
        return $this->set('dynamicCompressionBeforeCache', 'false');
    }

    public function enableDynamic()
    {
        return $this->set('doDynamicCompression', 'true');
    }

    public function enableStatic()
    {
        return $this->set('doStaticCompression', 'true');
    }

    public function enableDynamicBeforeCache()
    {
        return $this->set('dynamicCompressionBeforeCache', 'true');
    }

    protected function set($name, $value)
    {
        return $this->xml->{'system.webServer'}->urlCompression[$name] = $value;
    }
}