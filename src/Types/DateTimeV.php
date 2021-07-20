<?php

namespace AntanasGa\XmlRpcDecode\Types;

use AntanasGa\XmlRpcDecode\Common;
use DateTime;
use SimpleXMLElement;

/**
 * ***DateTimeV*** Handles `DateTime` elements
 */
class DateTimeV extends Common implements VInterface
{
    private static array $matches = [
        'dateTime.iso8601',
    ];

    /**
     * ***get*** parses `DateTime` value
     *
     * @param SimpleXMLElement $object
     * @return DateTime
     */
    public static function get(SimpleXMLElement $object)
    {
        $pickableType = self::matchVariable(self::$matches, $object, 'dateTime');
        return new DateTime($object->{$pickableType});
    }

    public static function names(): array
    {
        return self::$matches;
    }
}
