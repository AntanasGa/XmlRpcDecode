<?php

namespace AntanasGa\XmlRpcDecode\Types;

use AntanasGa\XmlRpcDecode\Common;
use SimpleXMLElement;

/**
 * ***Base64V*** Handles base64 strings
 */
class Base64V extends Common implements VInterface
{
    private static array $matches = [
        'base64',
    ];

    /**
     * ***get*** parses `base64` string
     *
     * @param SimpleXMLElement $object
     * @return string
     */
    public static function get(SimpleXMLElement $object)
    {
        $pickableType = self::matchVariable(self::$matches, $object, 'base64');
        $baseValue = (string) $object->{$pickableType};
        return base64_decode($baseValue);
    }

    public static function names(): array
    {
        return self::$matches;
    }
}
