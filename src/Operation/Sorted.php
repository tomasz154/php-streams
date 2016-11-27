<?php


namespace T2\Streams\Operation;

use T2\Streams\Exception\InvalidArgumentException;
use T2\Streams\Stream\ArrayStream;
use T2\Streams\Stream\StreamInterface;
use T2\Streams\TerminalOperation\ToArray;

class Sorted implements StreamInterface
{
    private $originalStream;
    private $sortedStream;

    public function __construct(StreamInterface $stream)
    {
        if (!$stream->isBounded()) {
            throw new InvalidArgumentException("Cannot sort unbounded stream");
        }

        $this->originalStream = $stream;
    }

    public function getCurrent()
    {
        return $this->getSortedStream()->getCurrent();
    }

    public function next()
    {
        return $this->getSortedStream()->next();
    }

    public function isBounded()
    {
        return true;
    }

    private function getSortedStream()
    {
        if (is_null($this->sortedStream)) {
            $sorted = (new ToArray($this->originalStream))->getValue();
            sort($sorted);
            $this->sortedStream = new ArrayStream($sorted);
        }

        return $this->sortedStream;
    }
}
