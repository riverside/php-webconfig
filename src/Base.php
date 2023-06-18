<?php
namespace PhpWebConfig;

class Base
{
    protected $filename = 'web.config';

    protected $xml = null;

    public function __construct($filename)
    {
        $this->filename = $filename;

        $this->xml = new \SimpleXMLElement($this->filename, 0, true);
    }

    public function format(): void
    {
        $dom = new \DOMDocument("1.0");
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($this->xml->asXML());
        $this->xml = new \SimpleXMLElement($dom->saveXML());
    }

    protected static function removeNode($node): bool
    {
        $dom = dom_import_simplexml($node);
        $dom->parentNode->removeChild($dom);

        return true;
    }

    protected function removeExpressions($expressions): bool
    {
        foreach ($expressions as $expression)
        {
            $result = $this->xml->xpath($expression);
            if (!$result)
            {
                continue;
            }

            foreach ($result as $node)
            {
                self::removeNode($node);
            }
        }

        return true;
    }

    public function getXml()
    {
        return $this->xml;
    }

    public function save($format = true): bool
    {
        if ($format)
        {
            $this->format();
        }

        return $this->xml->asXML($this->filename);
    }

    public function toString(): string
    {
        return $this->xml->asXML();
    }
}