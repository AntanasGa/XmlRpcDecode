<?php

namespace AntanasGa\XmlRpcDecode\Types;

use AntanasGa\XmlRpcDecode\Common;
use SimpleXMLElement;
use TypeError;
use ValueError;

/**
 * ***Value*** parsing determination class
 */
class Value extends Common
{
    // Class list for variable loading
    private static array $ClassToType = [
        'AntanasGa\XmlRpcDecode\Types\IntV',
        'AntanasGa\XmlRpcDecode\Types\ArrayV',
        'AntanasGa\XmlRpcDecode\Types\StructV',
        'AntanasGa\XmlRpcDecode\Types\StringV',
        'AntanasGa\XmlRpcDecode\Types\DoubleV',
        'AntanasGa\XmlRpcDecode\Types\BooleanV',
        'AntanasGa\XmlRpcDecode\Types\DateTimeV',
        'AntanasGa\XmlRpcDecode\Types\Base64V',
    ];
    
    // Makes sure that only needed elements are loaded
    private static array $mappedType = [];

    /**
     * ***get*** calls object determening method and returns value
     *
     * @return mixed
     */
    public static function get(SimpleXMLElement $value)
    {
        $result = null;
        $typeArray = array_keys(get_object_vars($value));
        $typeCount = count($typeArray);
        if ($typeCount > 1) {
            throw new ValueError('Supplied too many arguments for value');
        } elseif ($typeCount < 1) {
            throw new ValueError('Supplied too little arguments for value');
        }
        $type = $typeArray[0];
        self::mapVariable($type);
        if (!isset(self::$mappedType[$type])) {
            throw new TypeError(
                sprintf('Could not find reference for %s type', $type)
            );
        }
        $call = self::$mappedType[$type];
        $result = $call::get($value);
        return $result;
    }
    
    /**
     * ***mapVariable*** maps variable to `self::$mappedType`
     *
     * @param  string $name
     * @return void
     */
    private static function mapVariable(string $name)
    {
        // avoids remapping
        if (!isset(self::$mappedType[$name])) {
            foreach (self::$ClassToType as $class) {
                $classAcceptedTypes = $class::names();
                if (in_array($name, $classAcceptedTypes)) {
                    self::$mappedType[$name] = $class;
                    break;
                }
            }
        }
    }
}
