XmlRpcDecode
============

Easy way to decode XMLRPC requests 

## Documentation

### Installation
installation using composer:

`composer.json`:
```json
"require": {
    "antanasga/xmlrpcdecode": "^0.1.4"
}
```
In terminal:
```
$ composer require antanasga/xmlrpcdecode
```


### Usage

Interface trough `Decode` class.

`__construct` - takes string value of valid XML string, boolean value can be passed if there's a need for thrown error of fault codes

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
