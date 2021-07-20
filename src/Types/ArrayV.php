<?php

namespace AntanasGa\XmlRpcDecode\Types;

use AntanasGa\XmlRpcDecode\Common;
use SimpleXMLElement;

/**
 * ***ArrayV*** Handles array elements
 */
class ArrayV extends Common implements VInterface
{
    private static array $matches = [
        'array',
    ];

    /**
     * ***get*** parses `array`
     *
     * @param SimpleXMLElement $object
     * @return array
     */
    public static function get(SimpleXMLElement $object)
    {
        $result = [];
        $pickableType = self::matchVariable(self::$matches, $object, 'array');
        $values = $object->{$pickableType}->data->value;
        foreach ($values as $value) {
            $result[] = Value::get($value);
        }
        return $result;
    }

    public static function names(): array
    {
        return self::$matches;
    }
}
