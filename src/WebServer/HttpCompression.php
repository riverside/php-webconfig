<?php
namespace PhpWebConfig\WebServer;

use PhpWebConfig\Base;

/**
 * Configures HTTP compression settings for a Web server.
 *
 * @package PhpWebConfig\WebServer
 */
class HttpCompression extends Base
{
    /**
     * @var array
     */
    protected static $types = array('dynamic', 'static');

    /**
     * Adds a MIME type to the collection of dynamic or static MIME types.
     *
     * @param string $type
     * @param string $mimeType
     * @param bool $enabled
     * @return bool
     * @throws \Exception
     */
    protected function add(string $type, string $mimeType, bool $enabled=true): bool
    {
        if (!in_array($type, self::$types))
        {
            throw new \Exception('Invalid type.');
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

        return true;
    }

    /**
     * Adds a MIME type to the collection of dynamic MIME types.
     *
     * @param string $mimeType
     * @param bool $enabled
     * @return bool
     * @throws \Exception
     */
    public function addDynamic(string $mimeType, bool $enabled=true): bool
    {
        return $this->add('dynamic', $mimeType, $enabled);
    }

    /**
     * Adds a MIME type to the collection of static MIME types.
     *
     * @param string $mimeType
     * @param bool $enabled
     * @return bool
     * @throws \Exception
     */
    public function addStatic(string $mimeType, bool $enabled=true): bool
    {
        return $this->add('static', $mimeType, $enabled);
    }

    /**
     * @param string $type
     * @param string $mimeType
     * @param string $nodeName
     * @return string
     * @throws \Exception
     */
    protected function get(string $type, string $mimeType, string $nodeName): string
    {
        if (!in_array($type, self::$types))
        {
            throw new \Exception('Invalid type.');
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

        throw new \Exception('Node was not found.');
    }

    /**
     * @param string $mimeType
     * @param string $nodeName
     * @return string
     * @throws \Exception
     */
    public function getDynamic(string $mimeType, string $nodeName): string
    {
        return $this->get('dynamic', $mimeType, $nodeName);
    }

    /**
     * @param string $mimeType
     * @param string $nodeName
     * @return string
     * @throws \Exception
     */
    public function getStatic(string $mimeType, string $nodeName): string
    {
        return $this->get('static', $mimeType, $nodeName);
    }

    /**
     * @param string $type
     * @param string $mimeType
     * @param string|null $nodeName
     * @return bool
     * @throws \Exception
     */
    protected function has(string $type, string $mimeType, string $nodeName=null): bool
    {
        if (!in_array($type, self::$types))
        {
            throw new \Exception('Invalid type.');
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

    /**
     * @param string $mimeType
     * @param string|null $nodeName
     * @return bool
     * @throws \Exception
     */
    public function hasDynamic(string $mimeType, string $nodeName=null): bool
    {
        return $this->has('dynamic', $mimeType, $nodeName);
    }

    /**
     * @param string $mimeType
     * @param string|null $nodeName
     * @return bool
     * @throws \Exception
     */
    public function hasStatic(string $mimeType, string $nodeName=null): bool
    {
        return $this->has('static', $mimeType, $nodeName);
    }

    /**
     * Specifies configuration settings for dynamic compression.
     *
     * @return \SimpleXMLElement
     */
    protected function dynamicTypes(): \SimpleXMLElement
    {
        return $this->xml->{'system.webServer'}->httpCompression->dynamicTypes;
    }

    /**
     * Specifies configuration settings for static compression.
     *
     * @return \SimpleXMLElement
     */
    protected function staticTypes(): \SimpleXMLElement
    {
        return $this->xml->{'system.webServer'}->httpCompression->staticTypes;
    }

    /**
     * @param string $type
     * @param string|null $mimeType
     * @param string|null $nodeName
     * @return bool
     * @throws \Exception
     */
    protected function unmount(string $type, string $mimeType=null, string $nodeName=null): bool
    {
        if (!in_array($type, self::$types))
        {
            throw new \Exception('Invalid type.');
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

    /**
     * @param string|null $mimeType
     * @param string|null $nodeName
     * @return bool
     * @throws \Exception
     */
    public function unmountDynamic(string $mimeType=null, string $nodeName=null): bool
    {
        return $this->unmount('dynamic', $mimeType, $nodeName);
    }

    /**
     * @param string|null $mimeType
     * @param string|null $nodeName
     * @return bool
     * @throws \Exception
     */
    public function unmountStatic(string $mimeType=null, string $nodeName=null): bool
    {
        return $this->unmount('static', $mimeType, $nodeName);
    }
}