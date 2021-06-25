<?php

namespace AntanasGa\XmlRpcDecode\Types;

use ValueError;

/**
 * ***ArrayV*** Handles array elements
 */
class ArrayV implements VInterface
{
    private \SimpleXMLElement $object;

    /**
     * @param \SimpleXMLElement $object `array` object
     */
    public function __construct(\SimpleXMLElement $object)
    {
        if (!isset($object->data)) {
            throw new ValueError('Failed to decode Array');
        }
        $this->object = $object->data;
    }

    /**
     * ***get*** parses `array`
     *
     * @return array
     */
    public function get()
    {
        $result = [];
        if (count(get_object_vars($this->object)) > 0) {
            foreach ($this->object as $part) {
                $tmpValue = new Value($part);
                $tmpHolder = $tmpValue->get();
                $result[] = $tmpHolder;
            }
        }
        return $result;
    }
}
