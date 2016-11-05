<?php


namespace T2\Streams\TerminalOperation;


use T2\Streams\Stream\ArrayStream;
use T2\Streams\Stream\StreamInterface;

class ProductTest extends \PHPUnit_Framework_TestCase
{
    public function testNumbers()
    {
        $stream = new ArrayStream([10, 20, 30]);

        $op = new Product($stream);
        $this->assertEquals(6000, $op->getValue());
    }

    public function testEmpty()
    {
        $stream = new ArrayStream([]);
        $op = new Product($stream);
        $this->assertEquals(null, $op->getValue());
    }

    public function testItsLazy()
    {
        $test = $this;
        $stream = $this->prophesize(StreamInterface::class);
        $stream->getCurrent()->will(function () use ($test) {
            $test->fail();
        });
        $op = new Product($stream->reveal());
    }
}
