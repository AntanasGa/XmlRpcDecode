<?php

namespace AntanasGa\XmlRpcDecode;

/**
 * ***ResponseError*** Response error handling
 */
class ResponseError implements ErrorInterface
{
    public string $faultCode;
    public string $faultString;
}
