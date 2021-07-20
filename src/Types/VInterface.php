<?php

namespace AntanasGa\XmlRpcDecode\Types;

use SimpleXMLElement;

/**
 * ***VInterface*** common Value determination interface
 */
interface VInterface
{
    /**
     * ***get*** gets coresponding value of a type
     */
    public static function get(SimpleXMLElement $object);

    /**
     * ***names*** fetches available variants for decode type
     */
    public static function names(): array;
}
