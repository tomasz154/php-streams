<?php

namespace T2\Streams\Stream;

class Iterate implements StreamInterface
{
    private $current;
    private $call;

    public function __construct($start, callable $callable)
    {
        $this->current = $start;
        $this->call = $callable;
    }

    public function getCurrent()
    {
        $current = $this->current;
        $this->current = $this->findCurrent();
        return $current;
    }

    public function next()
    {
        $this->current = $this->findCurrent();
    }

    private function findCurrent()
    {
        return call_user_func($this->call, $this->current);
    }
}