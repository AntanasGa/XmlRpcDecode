<?php

namespace AntanasGa\XmlRpcDecode\Types;

use TypeError;
use ValueError;

/**
 * ***Value*** general value decode
 */
class Value
{
    private \SimpleXMLElement $object;

    /**
     * @param \SimpleXMLElement $object `param` value
     */
    public function __construct(\SimpleXMLElement $object)
    {
        if (!isset($object->value)) {
            throw new ValueError(
                sprintf('Structure key %s does not have a value', $object->name)
            );
        }
        $this->object = $object->value;
    }

    /**
     * ***get*** calls object determening method and returns value
     *
     * @return mixed
     */
    public function get()
    {
        $translator = null;
        $value = [];
        if (count($this->object) > 1) {
            foreach ($this->object as $part) {
                $translator = $this->handleSingle($part);
                $value[] = $translator->get();
            }
        } else {
            $translator = $this->handleSingle($this->object);
            $value = $translator->get();
        }
        return $value;
    }

    /**
     * ***handleSingle*** handles single value depending on its type
     *
     * @param  \SimpleXMLElement $part
     * @return VInterface
     */
    private function handleSingle(\SimpleXMLElement $part): VInterface
    {
        $translator = null;
        switch (true) {
            case (isset($part->int) || isset($part->i4)):
                if (isset($part->int)) {
                    $parted = $part->int;
                } else {
                    $parted = $part->i4;
                }
                $translator = new IntV($parted);
                break;
            case (isset($part->boolean)):
                $translator = new BooleanV($part->boolean);
                break;
            case (isset($part->string)):
                $translator = new StringV($part->string);
                break;
            case (isset($part->double)):
                $translator = new DoubleV($part->double);
                break;
            case ($this->isDateTime($part)):
                $b = "dateTime.iso8601";
                $translator = new DateTimeV($part->$b);
                break;
            case (isset($part->base64)):
                $translator = new StringV($part->base64, true);
                break;
            case (isset($part->array)):
                $translator = new ArrayV($part->array);
                break;
            case (isset($part->struct)):
                $translator = new StructV($part->struct);
                break;
            default:
                throw new TypeError('Could not match a type');
                break;
        }
        return $translator;
    }

    /**
     * ***isDateTime*** checks if `datetime` is isset
     *
     * @param  \SimpleXMLElement $part
     * @return bool
     */
    private function isDateTime(\SimpleXMLElement $part): bool
    {
        $b = "dateTime.iso8601";
        return isset($part->$b);
    }
}
