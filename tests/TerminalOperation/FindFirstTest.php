<?php


namespace T2\Streams\Tests\TerminalOperation;

use T2\Streams\Exception\EndOfStream;
use T2\Streams\Exception\NotFound;
use T2\Streams\Stream\StreamInterface;
use T2\Streams\TerminalOperation\FindFirst;

class FindFirstTest extends \PHPUnit_Framework_TestCase
{
    public function testItsWorking()
    {
        $stream = $this->prophesize(StreamInterface::class);
        $stream->getCurrent()->willReturn(42);

        $op = new FindFirst($stream->reveal());
        $this->assertEquals(42, $op->getValue());
    }

    public function testEmpty()
    {
        $stream = $this->prophesize(StreamInterface::class);
        $stream->getCurrent()->willThrow(EndOfStream::class);

        $op = new FindFirst($stream->reveal());
        $this->expectException(NotFound::class);
        $op->getValue();
    }

    public function testItsLazy()
    {
        $stream = $this->prophesize(StreamInterface::class);
        $stream->getCurrent()->shouldNotBeCalled();
        $op = new FindFirst($stream->reveal());
    }
}
