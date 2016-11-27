<?php


namespace T2\Streams\TerminalOperation;

use T2\Streams\Stream\StreamInterface;

class Concat extends Reduce
{
    public function __construct(StreamInterface $stream)
    {
        parent::__construct($stream, '', function ($carry, $item) {
            return $carry . $item;
        });
    }
}
