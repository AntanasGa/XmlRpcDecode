<?php

namespace AntanasGa\XmlRpcDecode\Types;

/**
 * ***BooleanV*** Handles boolean elements
 */
class BooleanV implements VInterface
{
    private \SimpleXMLElement $object;

    /**
     * @param \SimpleXMLElement $object `boolean` object
     */
    public function __construct(\SimpleXMLElement $object)
    {
        $this->object = $object;
    }

    /**
     * ***get*** parses `bool`
     *
     * @return bool
     */
    public function get()
    {
        return (bool) $this->object === "1";
    }
}
