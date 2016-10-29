<?php


namespace T2\Streams\TerminalOperation;


use T2\Streams\Stream\StreamInterface;

class Sum extends Reduce
{
    public function __construct(StreamInterface $stream)
    {
        parent::__construct($stream, 0, function ($carry, $item) {
            return $carry + $item;
        });
    }
}