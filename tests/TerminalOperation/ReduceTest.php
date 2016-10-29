<?php


namespace T2\Streams\TerminalOperation;


use T2\Streams\Stream\ArrayStream;
use T2\Streams\Stream\StreamInterface;

class ReduceTest extends \PHPUnit_Framework_TestCase
{
    public function testNumbers()
    {
        $stream = new ArrayStream([1, 2, 3]);

        $op = new Reduce($stream, 0, function ($carry, $item) {
            return $carry + $item;
        });
        $this->assertEquals(6, $op->getValue());
    }

    public function testStrings()
    {
        $stream = new ArrayStream(['a', 'b', 'c']);

        $op = new Reduce($stream, '', function ($carry, $item) {
            return trim($carry . ' ' . $item);
        });
        $this->assertEquals('a b c', $op->getValue());
    }

    public function testItsLazy()
    {
        $test = $this;
        $stream = $this->prophesize(StreamInterface::class);
        $stream->getCurrent()->will(function () use ($test) {
            $test->fail();
        });
        $op = new Reduce($stream->reveal(), 0, function () {
            return 1;
        });
    }
}
