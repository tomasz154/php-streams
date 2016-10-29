<?php


namespace T2\Streams\Operation;


use T2\Streams\Stream\StreamInterface;

class Skip implements StreamInterface
{
    private $stream;
    private $skip;
    private $current = 0;

    public function __construct(StreamInterface $stream, $n)
    {
        $this->stream = $stream;
        $this->skip = $n;
    }

    public function getCurrent()
    {
        // TODO: make it lazy
        for (; $this->current < $this->skip; $this->current++) {
            $this->stream->getCurrent();
        }

        return $this->stream->getCurrent();
    }
}