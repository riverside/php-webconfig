<?php
namespace PhpWebConfig\WebServer;

use PhpWebConfig\Base;

/**
 * Configures output cache settings.
 *
 * @package PhpWebConfig\WebServer
 */
class Caching extends Base
{
    /**
     * Sets a given values as caching attribute
     *
     * @param string $key
     * @param $value
     */
    protected function set(string $key, $value): void
    {
        $this->xml->{'system.webServer'}->caching[$key] = $value;
    }

    /**
     * Specifies whether page output caching is enabled.
     *
     * @param bool $value
     * @return Caching
     */
    public function setEnabled(bool $value): Caching
    {
        $this->set('enabled', $value ? 'true' : 'false');

        return $this;
    }

    /**
     * Specifies whether kernel caching is enabled.
     *
     * @param bool $value
     * @return Caching
     */
    public function setEnableKernelCache(bool $value): Caching
    {
        $this->set('enableKernelCache', $value ? 'true' : 'false');

        return $this;
    }

    /**
     * Specifies the maximum size of the output cache.
     *
     * @param int $value
     * @return Caching
     */
    public function setMaxCacheSize(int $value): Caching
    {
        $this->set('maxCacheSize', $value);

        return $this;
    }

    /**
     * Specifies the maximum response size that can be cached.
     *
     * @param int $value
     * @return Caching
     */
    public function setMaxResponseSize(int $value): Caching
    {
        $this->set('maxResponseSize', $value);

        return $this;
    }

    /**
     * Adds an output caching profile to the collection of output caching profiles.
     *
     * @param string $extension
     * @param string|null $policy
     * @param string|null $kernelCachePolicy
     * @param string|null $duration
     * @param string|null $varyByHeaders
     * @param string|null $varyByQueryString
     * @param string|null $location
     * @return bool
     */
    public function add(string $extension, string $policy=null, string $kernelCachePolicy=null, string $duration=null, string $varyByHeaders=null, string $varyByQueryString=null, string $location=null): bool
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

    /**
     * Removes all references to output caching profiles from the output caching profile collection.
     *
     * @return bool
     */
    public function clear(): bool
    {
        if ($this->has(null, 'clear'))
        {
            $this->unmount(null, 'clear');
        }

        $this->profiles()->addChild('clear');

        return true;
    }

    /**
     * Removes a reference to an output caching profile from the output caching profile collection.
     *
     * @param string $extension
     * @return bool
     */
    public function remove(string $extension): bool
    {
        if ($this->has($extension, 'remove'))
        {
            $this->unmount($extension, 'remove');
        }

        $child = $this->profiles()->addChild('remove');
        $child->addAttribute('extension', $extension);

        return true;
    }

    /**
     * @return bool
     */
    public function reset(): bool
    {
        $expressions = array(
            '//system.webServer/caching/profiles/remove',
            '//system.webServer/caching/profiles/add',
            '//system.webServer/caching/profiles/clear',
        );

        return $this->removeExpressions($expressions);
    }

    /**
     * @param string|null $extension
     * @param string|null $nodeName
     * @return bool
     */
    public function has(string $extension=null, string $nodeName=null): bool
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

    /**
     * Configures output cache settings.
     *
     * @return \SimpleXMLElement
     */
    protected function caching(): \SimpleXMLElement
    {
        return $this->xml->{'system.webServer'}->caching;
    }

    /**
     * Contains a group of output cache settings
     *
     * @return \SimpleXMLElement
     */
    protected function profiles(): \SimpleXMLElement
    {
        return $this->caching()->profiles;
    }

    /**
     * @param string|null $extension
     * @param string|null $nodeName
     * @return bool
     */
    protected function unmount(string $extension=null, string $nodeName=null): bool
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