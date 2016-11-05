<?php


namespace T2\Streams\TerminalOperation;


use T2\Streams\Stream\StreamInterface;

class Product extends Reduce
{
    public function __construct(StreamInterface $stream)
    {
        parent::__construct($stream, null, function ($carry, $item) {
            return is_null($carry) ? $item : $carry * $item;
        });
    }
}