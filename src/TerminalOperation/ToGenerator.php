<?php


namespace T2\Streams\TerminalOperation;


use T2\Streams\Exception\EndOfStream;
use T2\Streams\Stream\StreamInterface;

class ToGenerator implements TerminalOperationInterface
{
    private $stream;

    public function __construct(StreamInterface $stream)
    {
        $this->stream = $stream;
    }

    public function getValue()
    {
        while (true) {
            try {
                yield $this->stream->getCurrent();
            } catch (EndOfStream $e) {
                return;
            }
        }
    }
}