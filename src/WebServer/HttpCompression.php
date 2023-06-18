<?php
namespace PhpWebConfig\WebServer;

use PhpWebConfig\Base;

class HttpCompression extends Base
{
    protected static $types = array('dynamic', 'static');

    protected function add($type, $mimeType, $enabled=true)
    {
        if (!in_array($type, self::$types))
        {
            return false;
        }

        while ($this->has($type, $mimeType,'add'))
        {
            $this->unmount($type,$mimeType, 'add');
        }

        if ($type == 'dynamic')
        {
            $child = $this->dynamicTypes()->addChild('add');
        } else {
            $child = $this->staticTypes()->addChild('add');
        }
        $child->addAttribute('mimeType', $mimeType);
        $child->addAttribute('enabled', $enabled ? 'true' : 'false');
    }

    public function addDynamic($mimeType, $enabled=true)
    {
        return $this->add('dynamic', $mimeType, $enabled);
    }

    public function addStatic($mimeType, $enabled=true)
    {
        return $this->add('static', $mimeType, $enabled);
    }

    protected function get($type, $mimeType, $nodeName)
    {
        if (!in_array($type, self::$types))
        {
            return false;
        }

        if ($type == 'dynamic')
        {
            $collection = $this->dynamicTypes();
        } else {
            $collection = $this->staticTypes();
        }

        foreach ($collection->children() as $node)
        {
            if ($node->getName() == $nodeName && (string) $node['mimeType'] == $mimeType)
            {
                return (string) $node['enabled'];
            }
        }

        return false;
    }

    public function getDynamic($mimeType, $nodeName)
    {
        return $this->get('dynamic', $mimeType, $nodeName);
    }

    public function getStatic($mimeType, $nodeName)
    {
        return $this->get('static', $mimeType, $nodeName);
    }

    protected function has($type, $mimeType, $nodeName=null): bool
    {
        if (!in_array($type, self::$types))
        {
            return false;
        }

        if ($type == 'dynamic')
        {
            $collection = $this->dynamicTypes();
        } else {
            $collection = $this->staticTypes();
        }

        foreach ($collection->children() as $node)
        {
            if ((string) $node['mimeType'] == $mimeType && ($nodeName == null || $node->getName() == $nodeName))
            {
                return true;
            }
        }

        return false;
    }

    public function hasDynamic($mimeType, $nodeName=null): bool
    {
        return $this->has('dynamic', $mimeType, $nodeName);
    }

    public function hasStatic($mimeType, $nodeName=null): bool
    {
        return $this->has('static', $mimeType, $nodeName);
    }

    protected function dynamicTypes()
    {
        return $this->xml->{'system.webServer'}->httpCompression->dynamicTypes;
    }

    protected function staticTypes()
    {
        return $this->xml->{'system.webServer'}->httpCompression->staticTypes;
    }

    protected function unmount($type, $mimeType=null, $nodeName=null): bool
    {
        if (!in_array($type, self::$types))
        {
            return false;
        }

        if ($type == 'dynamic')
        {
            $collection = $this->dynamicTypes();
        } else {
            $collection = $this->staticTypes();
        }

        $i = 0;
        foreach ($collection->children() as $node)
        {
            if (($mimeType == null || (string) $node['mimeType'] == $mimeType) && ($nodeName == null || $node->getName() == $nodeName))
            {
                self::removeNode($node);
                $i += 1;
            }
        }

        return $i ? true : false;
    }

    public function unmountDynamic($mimeType=null, $nodeName=null): bool
    {
        return $this->unmount('dynamic', $mimeType, $nodeName);
    }

    public function unmountStatic($mimeType=null, $nodeName=null): bool
    {
        return $this->unmount('static', $mimeType, $nodeName);
    }
}