<?php


namespace T2\Streams\Tests\TerminalOperation;


use T2\Streams\Stream\ArrayStream;
use T2\Streams\Stream\StreamInterface;
use T2\Streams\TerminalOperation\ToGenerator;

class ToGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testNumbers()
    {
        $input = [10, 20, 30];
        $stream = new ArrayStream($input);

        $op = new ToGenerator($stream);
        $this->assertInstanceOf(\Generator::class, $op->getValue());
        $this->assertEquals($input, iterator_to_array($op->getValue()));
    }

    public function testItsLazy()
    {
        $test = $this;
        $stream = $this->prophesize(StreamInterface::class);
        $stream->getCurrent()->will(function () use ($test) {
            $test->fail('getCurrent was called');
        });
        $op = new ToGenerator($stream->reveal());
        $op->getValue();
    }
}
