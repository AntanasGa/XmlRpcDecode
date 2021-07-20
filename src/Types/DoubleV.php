<?php

namespace AntanasGa\XmlRpcDecode\Types;

use AntanasGa\XmlRpcDecode\Common;
use SimpleXMLElement;

/**
 * ***DoubleV*** Handles `double | float` elements
 */
class DoubleV extends Common implements VInterface
{
    private static array $matches = [
        'double',
    ];

    /**
     * ***get*** parses `double | float` value
     *
     * @param SimpleXMLElement $object
     * @return float
     */
    public static function get(SimpleXMLElement $object)
    {
        $pickableType = self::matchVariable(self::$matches, $object, 'double');
        return (float) $object->{$pickableType};
    }
    
    public static function names(): array
    {
        return self::$matches;
    }
}
