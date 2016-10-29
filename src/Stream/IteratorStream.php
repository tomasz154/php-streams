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
            $this->iterator->next();
            return $current;
        } else {
            throw new EndOfStream();
        }
    }
}