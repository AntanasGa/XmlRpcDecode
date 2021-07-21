<?php

require __DIR__ . '/../vendor/autoload.php';

use AntanasGa\XmlRpcDecode\Decode;
use AntanasGa\XmlRpcEncode\Encode;

$testCases = [
    // Type test
    'integer' => [1],
    'float/double'=> [1.1],
    'bool' => [true],
    'string' => ['string'],
    'array' => [[0, 1, 2, 3, 4, 5]],
    'associative array' => [
        [
            'a' => 0,
            'b' => 1,
            'c' => 2,
            'd' => 3,
            'e' => 4,
            'f' => 5,
        ],
    ],
    // mixed value tests
    'structured data array 1 variable' => [
        [
            [
                'id' => 0,
                'children_ids' => [1, 2, 3],
            ],
        ],
    ],
    'structured data array 2 or more variables' => [
        [
            'id' => 0,
            'children_ids' => [1, 2, 3],
        ],
        [
            'id' => 1,
            'children_ids' => [4, 5, 6],
        ],
    ],
    'mixed value array' => [
        [1, 1.1, 'hello world', 'a' => ['b', 'c']],
    ],
];

foreach ($testCases as $testName => $testCase) {
    printf('Test: %s... ', $testName);
    $encoded = new Encode($testCase);
    $parser = new Decode($encoded);
    $decoded = $parser->fetch();
    if ($decoded === $testCase) {
        echo 'Pass';
    } else {
        echo 'Fail';
    }
    echo "\n";
}

// DateTime test
echo 'Test: DateTime... ';
$testDate = new DateTime();
$testCase = [$testDate];
$encoded = new Encode($testCase);
$parser = new Decode($encoded);
$decoded = $parser->fetch();
if ($decoded[0]->format(DateTime::ISO8601) === $testDate->format(DateTime::ISO8601)) {
    echo 'Pass';
} else {
    echo 'Fail';
}
echo "\n";

// base64 test
echo 'Test: base64... ';
$testString = 'Hello world';
$encoded = new Encode([Encode::base64($testString)]);
$parser = new Decode($encoded);
$decoded = $parser->fetch();

if ([$testString] === $decoded) {
    echo 'Pass';
} else {
    echo 'Fail';
}
echo "\n";

echo 'Test: XML with new lines compared to without... ';
$encoded = "<?xml version='1.0'?>
<methodResponse>
<params>
<param>
<value><array><data>
<value><struct>
<member>
<name>a</name>
<value><string></string></value>
</member>
</struct></value>
</data></array></value>
</param>
</params>
</methodResponse>";

$parserUnchanged = new Decode($encoded);
$parserModified = new Decode(str_replace(["\n", "\r"], '', $encoded));
try {
    $decodedUnchanged = $parserUnchanged->fetch();
    $decodedModified = $parserModified->fetch();
    if ($decodedUnchanged === $decodedModified) {
        echo 'Pass';
    } else {
        echo 'Fail';
    }
} catch (TypeError $e) {
    echo 'Fail';
    echo "\n";
    echo $e;
}
echo "\n";
