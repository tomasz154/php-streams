<?php


namespace T2\Streams\TerminalOperation;


use T2\Streams\Stream\StreamInterface;

class Product extends Reduce
{
    public function __construct(StreamInterface $stream)
    {
        parent::__construct($stream, 1, function ($carry, $item) {
            return $carry * $item;
        });
    }
}