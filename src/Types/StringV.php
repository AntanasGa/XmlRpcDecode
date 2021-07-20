<?php

namespace AntanasGa\XmlRpcDecode\Types;

use AntanasGa\XmlRpcDecode\Common;
use SimpleXMLElement;

/**
 * ***StringV*** Handles `string` elements
 */
class StringV extends Common implements VInterface
{
    private static $matches = [
        'string',
    ];

    /**
     * ***get*** parses `string` value
     *
     * @param SimpleXMLElement $object
     * @return string
     */
    public static function get(SimpleXMLElement $object)
    {
        $pickableType = self::matchVariable(self::$matches, $object, 'string');
        return (string) $object->{$pickableType};
    }

    public static function names(): array
    {
        return self::$matches;
    }
}
