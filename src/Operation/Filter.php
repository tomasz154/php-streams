<?php

namespace T2\Streams\Operation;

use T2\Streams\Stream\StreamInterface;

class Filter implements StreamInterface
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
        do {
            $current = $this->stream->getCurrent();
        } while (!call_user_func($this->callable, $current));

        return $current;
    }

    public function next()
    {
        $this->getCurrent();
    }
}