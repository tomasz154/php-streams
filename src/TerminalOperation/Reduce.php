<?php


namespace T2\Streams\TerminalOperation;


use T2\Streams\Exception\EndOfStream;
use T2\Streams\Stream\StreamInterface;

class Reduce implements TerminalOperationInterface
{
    private $stream;
    private $initial;
    private $reduce;

    public function __construct(StreamInterface $stream, $initial, callable $reduce)
    {
        $this->stream = $stream;
        $this->initial = $initial;
        $this->reduce = $reduce;
    }

    public function getValue()
    {
        $current = $this->initial;
        while (true) {
            try {
                $current = call_user_func($this->reduce, $current, $this->stream->getCurrent());
            } catch (EndOfStream $e) {
                break;
            }
        }
        return $current;
    }
}