<?php
namespace PhpWebConfig\WebServer;

use PhpWebConfig\Base;

/**
 * Configures compression of static and dynamic content.
 *
 * @package PhpWebConfig\WebServer
 */
class UrlCompression extends Base
{
    /**
     * Disables dynamic compression for URLs.
     *
     * @return UrlCompression
     */
    public function disableDynamic(): UrlCompression
    {
        $this->set('doDynamicCompression', 'false');

        return $this;
    }

    /**
     * Disables static compression for URLs.
     *
     * @return UrlCompression
     */
    public function disableStatic(): UrlCompression
    {
        $this->set('doStaticCompression', 'false');

        return $this;
    }

    /**
     * Disables dynamic compression before cache
     *
     * @return UrlCompression
     */
    public function disableDynamicBeforeCache(): UrlCompression
    {
        $this->set('dynamicCompressionBeforeCache', 'false');

        return $this;
    }

    /**
     * Enables the dynamic compression for URLs.
     *
     * @return UrlCompression
     */
    public function enableDynamic(): UrlCompression
    {
        $this->set('doDynamicCompression', 'true');

        return $this;
    }

    /**
     * Enables static compression for URLs.
     *
     * @return UrlCompression
     */
    public function enableStatic(): UrlCompression
    {
        $this->set('doStaticCompression', 'true');

        return $this;
    }

    /**
     * Enables dynamic compression before cache
     *
     * @return UrlCompression
     */
    public function enableDynamicBeforeCache(): UrlCompression
    {
        $this->set('dynamicCompressionBeforeCache', 'true');

        return $this;
    }

    /**
     * Sets a given value as urlCompression attribute
     *
     * @param string $name
     * @param $value
     */
    protected function set(string $name, $value): void
    {
        $this->xml->{'system.webServer'}->urlCompression[$name] = $value;
    }
}