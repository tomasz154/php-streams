<?php


namespace T2\Streams\Tests\TerminalOperation;

use T2\Streams\Stream\ArrayStream;
use T2\Streams\Stream\StreamInterface;
use T2\Streams\TerminalOperation\Concat;

class ConcatTest extends \PHPUnit_Framework_TestCase
{
    public function testNumbers()
    {
        $stream = new ArrayStream([10, 20, 30]);

        $op = new Concat($stream);
        $this->assertEquals('102030', $op->getValue());
    }

    public function testString()
    {
        $stream = new ArrayStream(['a', 'b', 'c']);

        $op = new Concat($stream);
        $this->assertEquals('abc', $op->getValue());
    }

    public function testItsLazy()
    {
        $test = $this;
        $stream = $this->prophesize(StreamInterface::class);
        $stream->getCurrent()->will(function () use ($test) {
            $test->fail('getCurrent was called');
        });
        $stream->isBounded()->willReturn(true);
        $op = new Concat($stream->reveal());
    }
}
