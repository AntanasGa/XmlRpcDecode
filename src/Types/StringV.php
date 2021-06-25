<?php

namespace AntanasGa\XmlRpcDecode\Types;

/**
 * ***StringV*** Handles `int` elements
 */
class StringV implements VInterface
{
    private \SimpleXMLElement $object;
    private bool $base64 = false;

    /**
     * @param \SimpleXMLElement $object `string` object
     * @param bool $base64 specify if value is in base64
     */
    public function __construct(\SimpleXMLElement $object, bool $base64 = false)
    {
        $this->object = $object;
        $this->base64 = $base64;
    }

    /**
     * ***get*** parses `string`
     *
     * @return string
     */
    public function get()
    {
        $result = (string) $this->object;
        if ($this->base64) {
            $result = base64_decode($result);
        }
        return $result;
    }
}
