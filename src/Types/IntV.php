<?php

namespace AntanasGa\XmlRpcDecode\Types;

/**
 * ***IntV*** Handles `int` elements
 */
class IntV implements VInterface
{
    private \SimpleXMLElement $object;

    /**
     * @param \SimpleXMLElement $object `int` object
     */
    public function __construct(\SimpleXMLElement $object)
    {
        $this->object = $object;
    }

    /**
     * ***get*** parses `int`
     *
     * @return int
     */
    public function get()
    {
        return (int) $this->object;
    }
}
