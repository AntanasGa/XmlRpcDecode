<?php

namespace AntanasGa\XmlRpcDecode;

use Exception;
use SimpleXMLElement;

/**
 * ***Common*** Class for common functions used accross library
 */
class Common
{    
    /**
     * ***whatValueInArray*** find any needle in stack
     *
     * @param  array $needles search values
     * @param  array $haystack serchable array
     * @return string|null
     */
    public static function whatValueInArray(array $needles, array $haystack)
    {
        $result = null;
        foreach ($needles as $needle) {
            if (in_array($needle, $haystack)) {
                $result = $needle;
                break;
            }
        }
        return $result;
    }

    /**
     * ***matchVariable*** Checks if variable exists in matchable array
     *
     * @param  array $parsable parsable keys
     * @param  SimpleXMLElement $object value xml object
     * @param  string $type type for error throwing
     * @return string
     */
    public static function matchVariable(array $parsable, SimpleXMLElement $object, string $type): string
    {
        $existingType = array_keys(get_object_vars($object));
        $pickableType = self::whatValueInArray($parsable, $existingType);
        if ($pickableType === null) {
            throw new Exception(
                sprintf('Failed to decode %s, found null', $type)
            );
        }
        return $pickableType;
    }
}
