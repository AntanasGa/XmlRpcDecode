<?php

namespace AntanasGa\XmlRpcDecode\Types;

use ValueError;

/**
 * ***StructV*** Handles `array` elements that are keyed
 */
class StructV implements VInterface
{
    private \SimpleXMLElement $object;

    /**
     * @param \SimpleXMLElement $object `struct` object
     */
    public function __construct(\SimpleXMLElement $object)
    {
        if (!isset($object->member) || count($object->member) < 1) {
            throw new ValueError('Structure has no members');
        }
        $this->object = $object->member;
    }

    /**
     * ***get*** parses `array` with keys
     *
     * @return array
     */
    public function get()
    {
        $result = [];
        foreach ($this->object as $part) {
            if (!isset($part->name)) {
                throw new ValueError('Struct element does not have a key (name)');
            }
            $value = new Value($part);
            $tmpHold = $value->get();
            $result[(string) $part->name] = $tmpHold;
        }
        return $result;
    }
}
