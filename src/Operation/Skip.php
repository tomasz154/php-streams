<?php


namespace T2\Streams\Operation;


use T2\Streams\Stream\StreamInterface;

class Skip implements StreamInterface
{
    private $stream;
    private $skip;
    private $current = 0;

    public function __construct(StreamInterface $stream, $number)
    {
        $this->stream = $stream;
        $this->skip = $number;
    }

    public function getCurrent()
    {
        for (; $this->current < $this->skip; $this->current++) {
            $this->next();
        }

        return $this->stream->getCurrent();
    }

    public function next()
    {
        return $this->stream->next();
    }
}