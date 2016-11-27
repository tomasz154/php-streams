<?php

namespace T2\Streams\Operation;

use T2\Streams\Stream\StreamInterface;

class Map implements StreamInterface
{
    private $stream;
    private $callable;

    public function __construct(StreamInterface $stream, callable $callable)
    {
        $this->stream = $stream;
        $this->callable = $callable;
    }

    public function getCurrent()
    {
        return call_user_func($this->callable, $this->stream->getCurrent());
    }

    public function next()
    {
        return $this->stream->next();
    }

    public function isBounded()
    {
        return $this->stream->isBounded();
    }
}
