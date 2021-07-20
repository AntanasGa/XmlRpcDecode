<?php

namespace AntanasGa\XmlRpcDecode\Types;

use AntanasGa\XmlRpcDecode\Common;
use Exception;
use SimpleXMLElement;

/**
 * ***ArrayV*** Handles struct (associative array) elements
 */
class StructV extends Common implements VInterface
{
    private static array $matches = [
        'struct',
    ];

    /**
     * ***get*** parses `struct` value
     *
     * @param SimpleXMLElement $object
     * @return array
     */
    public static function get(SimpleXMLElement $object)
    {
        $result = [];
        $pickableType = self::matchVariable(self::$matches, $object, 'struct (associative array)');
        $members = $object->{$pickableType}->member;
        foreach ($members as $member) {
            if ($member->name === null) {
                throw new Exception('Failed to link a member with a key of null');
            }
            $result[(string) $member->name] = Value::get($member->value);
        }
        return $result;
    }

    public static function names(): array
    {
        return self::$matches;
    }
}
