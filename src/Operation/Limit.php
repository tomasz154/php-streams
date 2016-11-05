<?php
namespace T2\Streams\Operation;

use T2\Streams\Exception\EndOfStream;
use T2\Streams\Stream\StreamInterface;

class Limit implements StreamInterface
{
    private $stream;
    private $limit;
    private $count = 0;

    public function __construct(StreamInterface $stream, $limit)
    {
        $this->stream = $stream;
        $this->limit = $limit;
    }

    public function getCurrent()
    {
        if ($this->count < $this->limit) {
            $this->count++;
            return $this->stream->getCurrent();
        } else {
            throw new EndOfStream();
        }
    }

    public function next()
    {
        $this->count++;
    }
}