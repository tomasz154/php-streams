<?php

use T2\Streams\Stream;

require_once 'vendor/autoload.php';

var_dump(
    Stream::iterate(1, function ($i) {
        return $i + 1;
    })
        ->limit(3)
        ->sum()
);

var_dump(
    Stream::fromArray([1, 2, 3, 4, 5, 6])
        ->filter(function ($x) {
            return $x % 2 == 0;
        })
        ->map(function ($x) {
            return $x * 2;
        })
        ->limit(2)
        ->toArray()
);

var_dump(
    Stream::fromIterator(new ArrayIterator([1, 2, 3, 4, 5, 6]))
        ->filter(function ($x) {
            return $x % 2 == 0;
        })
        ->map(function ($x) {
            return $x * 2;
        })
        ->map('floatval')
        ->limit(2)
        ->toArray()
);
