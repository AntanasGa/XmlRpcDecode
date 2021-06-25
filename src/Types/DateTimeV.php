<?php

namespace AntanasGa\XmlRpcDecode\Types;

use DateTime;

/**
 * ***DateTimeV*** Handles `DateTime` elements
 */
class DateTimeV implements VInterface
{
    private \SimpleXMLElement $object;

    /**
     * @param \SimpleXMLElement $object `datetime` object
     */
    public function __construct(\SimpleXMLElement $object)
    {
        $this->object = $object;
    }

    /**
     * ***get*** parses `DateTime`
     *
     * @return void
     */
    public function get()
    {
        return new DateTime((string) $this->object);
    }
}
