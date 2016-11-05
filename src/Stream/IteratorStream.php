<?php


namespace T2\Streams\Stream;


use T2\Streams\Exception\EndOfStream;

class IteratorStream implements StreamInterface
{
    protected $iterator;

    public function __construct(\Iterator $iterator)
    {
        $this->iterator = $iterator;
    }

    public function getCurrent()
    {
        if ($this->iterator->valid()) {
            $current = $this->iterator->current();
            $this->next();
            return $current;
        }

        throw new EndOfStream();
    }

    public function next()
    {
        $this->iterator->next();
    }

    public function isBounded()
    {
        return false;
    }
}