<?php

namespace AntanasGa\XmlRpcDecode;

/**
 * ***XMLError*** XML error handling
 */
class XMLError implements ErrorInterface
{
    public string $faultCode;
    public string $faultString;
}
