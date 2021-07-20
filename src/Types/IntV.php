<?php

namespace AntanasGa\XmlRpcDecode\Types;

use AntanasGa\XmlRpcDecode\Common;
use SimpleXMLElement;

/**
 * ***IntV*** Handles `int` elements
 */
class IntV extends Common implements VInterface
{
    private static array $matches = [
        'int',
        'i4',
    ];

    /**
     * ***get*** parses `int` value
     *
     * @param SimpleXMLElement $object
     * @return int
     */
    public static function get(SimpleXMLElement $object)
    {
        $pickableType = self::matchVariable(self::$matches, $object, 'int');
        return (int) $object->{$pickableType};
    }

    public static function names(): array
    {
        return self::$matches;
    }
}
