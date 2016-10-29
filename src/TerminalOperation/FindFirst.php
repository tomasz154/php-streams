<?php


namespace T2\Streams\TerminalOperation;


use T2\Streams\Exception\EndOfStream;
use T2\Streams\Exception\NotFound;
use T2\Streams\Stream\StreamInterface;

class FindFirst implements TerminalOperationInterface
{
    private $stream;

    public function __construct(StreamInterface$stream)
    {
        $this->stream = $stream;
    }

    public function getValue()
    {
        try {
            return $this->stream->getCurrent();
        } catch (EndOfStream $e) {
            throw new NotFound();
        }
    }
}