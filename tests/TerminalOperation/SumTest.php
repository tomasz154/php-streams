<?php


namespace T2\Streams\Tests\TerminalOperation;

use T2\Streams\Stream\ArrayStream;
use T2\Streams\Stream\StreamInterface;
use T2\Streams\TerminalOperation\Product;
use T2\Streams\TerminalOperation\Sum;

class SumTest extends \PHPUnit_Framework_TestCase
{
    public function testNumbers()
    {
        $stream = new ArrayStream([10, 20, 30]);

        $op = new Sum($stream);
        $this->assertEquals(60, $op->getValue());
    }

    public function testEmpty()
    {
        $stream = new ArrayStream([]);
        $op = new Product($stream);
        $this->assertEquals(0, $op->getValue());
    }

    public function testItsLazy()
    {
        $test = $this;
        $stream = $this->prophesize(StreamInterface::class);
        $stream->getCurrent()->will(function () use ($test) {
            $test->fail('getCurrent was called');
        });
        $stream->isBounded()->willReturn(true);
        $op = new Sum($stream->reveal());
    }
}
