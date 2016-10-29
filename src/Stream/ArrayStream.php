<?php

namespace T2\Streams\Stream;

class ArrayStream extends IteratorStream
{
    public function __construct(array $array)
    {
        parent::__construct(new \ArrayIterator($array));
    }
}