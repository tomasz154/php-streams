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
        $return = $this->current;
        $this->current = call_user_func($this->call, $this->current);
        return $return;
    }

    public function next()
    {
        $this->getCurrent();
    }

    public function isBounded()
    {
        return false;
    }
}
