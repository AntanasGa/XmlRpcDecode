<?php

namespace AntanasGa\XmlRpcDecode;

interface ErrorInterface
{
    public string $faultCode;
    public string $faultString;
}
