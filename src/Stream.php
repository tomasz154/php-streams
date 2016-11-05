<?php

namespace T2\Streams;

use T2\Streams\Operation\Filter;
use T2\Streams\Operation\Limit;
use T2\Streams\Operation\Map;
use T2\Streams\Operation\Skip;
use T2\Streams\Stream\ArrayStream;
use T2\Streams\Stream\Iterate;
use T2\Streams\Stream\IteratorStream;
use T2\Streams\Stream\StreamInterface;
use T2\Streams\TerminalOperation\Concat;
use T2\Streams\TerminalOperation\FindFirst;
use T2\Streams\TerminalOperation\Reduce;
use T2\Streams\TerminalOperation\Sum;
use T2\Streams\TerminalOperation\ToArray;
use T2\Streams\TerminalOperation\ToGenerator;

class Stream
{
    private $stream;

    protected function __construct(StreamInterface $stream)
    {
        $this->stream = $stream;
    }

    public static function iterate($start, callable $call)
    {
        return new static(new Iterate($start, $call));
    }

    public static function fromArray(array $array)
    {
        return new static(new ArrayStream($array));
    }

    public static function fromIterator(\Iterator $iterator)
    {
        return new static(new IteratorStream($iterator));
    }

    public function limit($n)
    {
        return new static(new Limit($this->stream, $n));
    }

    public function skip($n)
    {
        return new static(new Skip($this->stream, $n));
    }

    public function map(callable $map)
    {
        return new static(new Map($this->stream, $map));
    }

    public function filter(callable $filter)
    {
        return new static(new Filter($this->stream, $filter));
    }

    public function reduce($initial, callable $reduce)
    {
        return (new Reduce($this->stream, $initial, $reduce))->getValue();
    }

    public function toArray()
    {
        return (new ToArray($this->stream))->getValue();
    }

    public function toGenerator()
    {
        return (new ToGenerator($this->stream))->getValue();
    }

    public function findFirst()
    {
        return (new FindFirst($this->stream))->getValue();
    }

    public function sum()
    {
        return (new Sum($this->stream))->getValue();
    }

    public function concat()
    {
        return (new Concat($this->stream))->getValue();
    }
}