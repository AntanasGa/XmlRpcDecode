<?php

namespace AntanasGa\XmlRpcDecode\Types;

/**
 * ***DoubleV*** Handles `float` elements
 */
class DoubleV implements VInterface
{
    private \SimpleXMLElement $object;

    /**
     * @param \SimpleXMLElement $object `double` object
     */
    public function __construct(\SimpleXMLElement $object)
    {
        $this->object = $object;
    }

    /**
     * ***get*** parses `float`
     *
     * @return float
     */
    public function get()
    {
        return (float) $this->object;
    }
}
