<?php


namespace T2\Streams\TerminalOperation;


use T2\Streams\Stream\StreamInterface;

class FindFirstTest extends \PHPUnit_Framework_TestCase
{
    public function testItsWorking()
    {
        $stream = $this->prophesize(StreamInterface::class);
        $stream->getCurrent()->willReturn(42);

        $op = new FindFirst($stream->reveal());
        $this->assertEquals(42, $op->getValue());
    }

    public function testItsLazy()
    {
        $stream = $this->prophesize(StreamInterface::class);
        $stream->getCurrent()->shouldNotBeCalled();
        $op = new FindFirst($stream->reveal());
    }
}