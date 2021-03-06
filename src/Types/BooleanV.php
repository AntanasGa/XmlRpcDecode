<?php

namespace AntanasGa\XmlRpcDecode\Types;

use AntanasGa\XmlRpcDecode\Common;
use SimpleXMLElement;

/**
 * ***BooleanV*** Handles `bool` elements
 */
class BooleanV extends Common implements VInterface
{
    private static array $matches = [
        'boolean',
    ];

    /**
     * ***get*** parses `boolean` value
     *
     * @param SimpleXMLElement $object
     * @return bool
     */
    public static function get(SimpleXMLElement $object)
    {
        $pickableType = self::matchVariable(self::$matches, $object, 'boolean');
        return (string) $object->{$pickableType} === '1';
    }
    
    public static function names(): array
    {
        return self::$matches;
    }
}
