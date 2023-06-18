<?php
namespace PhpWebConfig\WebServer;

use PhpWebConfig\Base;

class CustomHeaders extends Base
{
    public function add($name, $value): bool
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

    public function get($name, $type)
    {
        foreach ($this->all()->children() as $node)
        {
            if ($node->getName() == $type && (string) $node['name'] == $name)
            {
                return (string) $node['value'];
            }
        }

        return false;
    }

    public function has($name, $type=null): bool
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

    public function remove($name): bool
    {
        if ($this->has($name, 'remove'))
        {
            $this->unmount($name, 'remove');
        }

        $child = $this->all()->addChild('remove');
        $child->addAttribute('name', $name);

        return true;
    }

    public function reset()
    {
        $expressions = array(
            '//system.webServer/httpProtocol/customHeaders/remove',
            '//system.webServer/httpProtocol/customHeaders/add',
            '//system.webServer/httpProtocol/customHeaders/clear',
        );

        return $this->removeExpressions($expressions);
    }

    protected function all()
    {
        return $this->xml->{'system.webServer'}->httpProtocol->customHeaders;
    }

    protected function unmount($name, $type=null): bool
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