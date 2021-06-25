<?php

namespace AntanasGa\XmlRpcDecode;

use AntanasGa\XmlRpcDecode\Types\Value;
use ValueError;

/**
 * ***Decode*** decodes XMLRPC response to array
 */
class Decode
{
    private string $xmlData;
    private ?ResponseError $error = null;

    /**
     * @param  string $xmlData XML string
     */
    public function __construct(string $xmlData)
    {
        $this->xmlData = $xmlData;
    }

    /**
     * ***fetch*** decodes xml string to array
     *
     * @return array value array
     */
    public function fetch(): array
    {
        $result = [];
        $xmlObject = simplexml_load_string($this->xmlData);
        if (isset($xmlObject->fault)) {
            $this->decodeFault($xmlObject->fault);
        } elseif (isset($xmlObject->params)) {
            $result = $this->decodeSuccess($xmlObject->params);
        }
        return $result;
    }

    /**
     * ***errorInfo*** if error message presant returns ResponseError object
     *
     * @return null|ResponseError object contains `faultCode` and `faultString`
     */
    public function errorInfo()
    {
        return $this->error;
    }

    /**
     * ***decodeSuccess*** decodes successful response
     *
     * @param  \SimpleXMLElement $object params object
     * @return array
     */
    private function decodeSuccess(\SimpleXMLElement $object): array
    {
        if (count($object->param) < 1) {
            throw new ValueError('No parameters found in response');
        }
        $result = [];
        if (count($object->param) > 1) {
            foreach ($object->param as $part) {
                $value = new Value($part);
                $tmpResult = $value->get();
                $result[] = $tmpResult;
            }
        } elseif (count($object->param) === 1) {
            $value = new Value($object->param);
            $tmpResult = $value->get();
            $result = $tmpResult;
        }
        return $result;
    }

    /**
     * ***decodeFault*** decodes error message from response
     *
     * @param \SimpleXMLElement $object
     * @return void
     */
    private function decodeFault(\SimpleXMLElement $object)
    {
        if (!isset($object->value)) {
            throw new ValueError('No value set');
        }
        $ob = new Value($object);
        $e = $ob->get();
        if (!isset($e['faultCode'])) {
            throw new ValueError('No faultCode found');
        } elseif (!isset($e['faultString'])) {
            throw new ValueError('No faultString found');
        }
        $this->error = new ResponseError();
        $this->error->faultCode = $e['faultCode'];
        $this->error->faultString = $e['faultString'];
    }
}
