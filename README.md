XmlRpcDecode
============

Easy way to decode XMLRPC requests 

## Documentation

### Installation
installation using composer:

```json
"require": {
    "AntanasGa/XmlRpcDecode": "^0.1.0"
}
```

### Usage

Interface trough `Decode` class.

`__construct` - takes string value of valid XML string

`fetch` - method returns value array

`errorInfo` - method returns `ResponseError` object with `faultCode` and `faultString` values

```php
// ...
$e = new Decode($validXMLString);

var_dump($e->fetch());

if ($e->errorInfo() !== null) {
    die(); // your error handling
}
```
