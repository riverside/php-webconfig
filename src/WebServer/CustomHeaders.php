<?php
namespace PhpWebConfig\WebServer;

use PhpWebConfig\Base;

/**
 * Configures custom response headers that are returned in responses from the Web server.
 *
 * @package PhpWebConfig\WebServer
 */
class CustomHeaders extends Base
{
    /**
     * Adds a custom response header to the <customHeaders> collection.
     * 
     * @param string $name
     * @param $value
     * @return bool
     */
    public function add(string $name, $value): bool
    {
        if ($this->has($name, 'add'))
        {
            $this->unmount($name, 'add');
        }

        $child = $this->all()->addChild('add');
        $child->addAttribute('name', $name);
        $child->addAttribute('value', $value);

        return true;
    }

    /**
     * @param string $name
     * @param string $type
     * @return string
     * @throws \Exception
     */
    public function get(string $name, string $type): string
    {
        foreach ($this->all()->children() as $node)
        {
            if ($node->getName() == $type && (string) $node['name'] == $name)
            {
                return (string) $node['value'];
            }
        }

        throw new \Exception('Header not found.');
    }

    /**
     * @param string $name
     * @param string|null $type
     * @return bool
     */
    public function has(string $name, string $type=null): bool
    {
        foreach ($this->all()->children() as $node)
        {
            if ((string) $node['name'] == $name && ($type == null || $node->getName() == $type))
            {
                return true;
            }
        }

        return false;
    }

    /**
     * Removes a reference to a custom response header from the <customHeaders> collection.
     *
     * @param string $name
     * @return bool
     */
    public function remove(string $name): bool
    {
        if ($this->has($name, 'remove'))
        {
            $this->unmount($name, 'remove');
        }

        $child = $this->all()->addChild('remove');
        $child->addAttribute('name', $name);

        return true;
    }

    /**
     * @return bool
     */
    public function reset(): bool
    {
        $expressions = array(
            '//system.webServer/httpProtocol/customHeaders/remove',
            '//system.webServer/httpProtocol/customHeaders/add',
            '//system.webServer/httpProtocol/customHeaders/clear',
        );

        return $this->removeExpressions($expressions);
    }

    /**
     * @return \SimpleXMLElement
     */
    protected function all(): \SimpleXMLElement
    {
        return $this->xml->{'system.webServer'}->httpProtocol->customHeaders;
    }

    /**
     * @param string $name
     * @param string|null $type
     * @return bool
     */
    protected function unmount(string $name, string $type=null): bool
    {
        foreach ($this->all()->children() as $node)
        {
            if ((string) $node['name'] == $name && ($type == null || $node->getName() == $type))
            {
                self::removeNode($node);
                return true;
            }
        }

        return false;
    }
}