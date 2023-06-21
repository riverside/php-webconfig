<?php
namespace PhpWebConfig;

class Base
{
    /**
     * @var string
     */
    protected $filename = 'web.config';

    /**
     * @var \SimpleXMLElement
     */
    protected $xml;

    /**
     * Base constructor.
     *
     * @param string $filename
     */
    public function __construct(string $filename)
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

    /**
     * @param \SimpleXMLElement $node
     * @return bool
     */
    protected static function removeNode(\SimpleXMLElement $node): bool
    {
        $dom = dom_import_simplexml($node);
        $dom->parentNode->removeChild($dom);

        return true;
    }

    /**
     * @param array $expressions
     * @return bool
     */
    protected function removeExpressions(array $expressions): bool
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

    /**
     * @return \SimpleXMLElement
     */
    public function getXml(): \SimpleXMLElement
    {
        return $this->xml;
    }

    /**
     * @param bool $format
     * @return bool
     */
    public function save(bool $format = true): bool
    {
        if ($format)
        {
            $this->format();
        }

        return $this->xml->asXML($this->filename);
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->xml->asXML();
    }
}