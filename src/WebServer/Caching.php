<?php
namespace PhpWebConfig\WebServer;

use PhpWebConfig\Base;

class Caching extends Base
{
    protected function set($key, $value)
    {
        $this->xml->{'system.webServer'}->caching[$key] = $value;
    }

    public function setEnabled($value)
    {
        $this->set('enabled', (bool) $value ? 'true' : 'false');
    }

    public function setEnableKernelCache($value)
    {
        $this->set('enableKernelCache', (bool) $value ? 'true' : 'false');
    }

    public function setMaxCacheSize($value)
    {
        $this->set('maxCacheSize', $value);
    }

    public function setMaxResponseSize($value)
    {
        $this->set('maxResponseSize', $value);
    }

    public function add($extension, $policy=null, $kernelCachePolicy=null, $duration=null, $varyByHeaders=null, $varyByQueryString=null, $location=null): bool
    {
        if ($this->has($extension, 'add'))
        {
            $this->unmount($extension, 'add');
        }

        $child = $this->profiles()->addChild('add');
        $child->addAttribute('extension', $extension); //.php, .asp
        if ($policy != null)
        {
            $child->addAttribute('policy', $policy); //DisableCache, DontCache, CacheUntilChange, CacheForTimePeriod
        }
        if ($kernelCachePolicy != null)
        {
            $child->addAttribute('kernelCachePolicy', $kernelCachePolicy); // DisableCache, DontCache, CacheUntilChange, CacheForTimePeriod
        }
        if ($duration != null)
        {
            $child->addAttribute('duration', $duration); // 00:00:00
        }
        if ($varyByHeaders != null)
        {
            $child->addAttribute('varyByHeaders', $varyByHeaders); //Accept-Language, Accept-Charset
        }
        if ($varyByQueryString != null)
        {
            $child->addAttribute('varyByQueryString', $varyByQueryString); //Locale, Culture
        }
        if ($location != null)
        {
            $child->addAttribute('location', $location); //Any, Client, Downstream, Server, None, ServerAndClient
        }

        return true;
    }

    public function clear(): bool
    {
        if ($this->has(null, 'clear'))
        {
            $this->unmount(null, 'clear');
        }

        $this->profiles()->addChild('clear');

        return true;
    }

    public function remove($extension): bool
    {
        if ($this->has($extension, 'remove'))
        {
            $this->unmount($extension, 'remove');
        }

        $child = $this->profiles()->addChild('remove');
        $child->addAttribute('extension', $extension);

        return true;
    }

    public function reset()
    {
        $expressions = array(
            '//system.webServer/caching/profiles/remove',
            '//system.webServer/caching/profiles/add',
            '//system.webServer/caching/profiles/clear',
        );

        return $this->removeExpressions($expressions);
    }

    public function has($extension=null, $nodeName=null): bool
    {
        foreach ($this->profiles()->children() as $node)
        {
            if (($extension == null || (string) $node['extension'] == $extension) && ($nodeName == null || $node->getName() == $nodeName))
            {
                return true;
            }
        }

        return false;
    }

    protected function caching()
    {
        return $this->xml->{'system.webServer'}->caching;
    }

    protected function profiles()
    {
        return $this->caching()->profiles;
    }

    protected function unmount($extension=null, $nodeName=null): bool
    {
        foreach ($this->profiles()->children() as $node)
        {
            if (($extension == null || (string) $node['extension'] == $extension) && ($nodeName == null || $node->getName() == $nodeName))
            {
                self::removeNode($node);
                return true;
            }
        }

        return false;
    }
}