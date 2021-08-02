<?php

namespace AntanasGa\XmlRpcDecode;

use AntanasGa\XmlRpcDecode\Types\Value;
use Exception;
use SimpleXMLElement;

/**
 * ***Decode*** decodes XMLRPC response to array
 */
class Decode
{
    private SimpleXMLElement $xmlData;
    private ?ErrorInterface $error = null;
    private bool $throw = false;

    /**
     * @param string $xmlData XML string
     * @param bool $throw throw error on Error response (by default false for legacy) 
     */
    public function __construct(string $xmlData, bool $throw = false)
    {
        $this->xmlData = simplexml_load_string($xmlData);
        if ($this->xmlData === false && $throw) {
            throw new Exception('XML could not be parsed');
        }
        $this->throw = $throw;
    }

    /**
     * ***fetch*** decodes xml string to array
     *
     * @return array value array
     */
    public function fetch(): array
    {
        $result = [];
        if ($this->xmlData === false) {
            $this->xmlError();
        } else {
            $result = $this->handle();
        }
        return $result;
    }

    /**
     * ***errorInfo*** if error message presant returns ErrorInterface object
     *
     * @return null|ErrorInterface object contains `faultCode` and `faultString`
     */
    public function errorInfo(): ?ErrorInterface
    {
        return $this->error;
    }
    
    /**
     * ***handle*** Handles general XML object
     *
     * @return array
     */
    private function handle(): array
    {
        $result = [];
        if (isset($this->xmlData->fault)) {
            $this->decodeFault();
        } else {
            $result = $this->decodeSuccess();
        }
        return $result;
    }

    /**
     * ***decodeSuccess*** decodes successful response
     *
     * @return array
     */
    private function decodeSuccess(): array
    {
        $result = [];
        foreach ($this->xmlData->params->children() as $param) {
            $result[] = Value::get($param->value);
        }
        return $result;
    }

    /**
     * ***decodeFault*** decodes error message from response
     *
     * @return void
     */
    private function decodeFault()
    {
        $parsed = Value::get($this->xmlData->fault->value);
        if ($this->throw) {
            throw new Exception(
                sprintf('%s : %s', $parsed['faultCode'], $parsed['faultString'])
            );
        }
        $this->error = new ResponseError();
        $this->error->faultCode = $parsed['faultCode'];
        $this->error->faultString = $parsed['faultString'];
    }

    /**
     * ***xmlError*** Sets `$this->error` value with `XMLError` object and its values
     *
     * @return void
     */
    private function xmlError()
    {
        $this->error = new XMLError();
        $this->error->faultCode = 'XML not parsable';
        $this->error->faultString = 'Could not parse XML file, please check your input';
    }
}
