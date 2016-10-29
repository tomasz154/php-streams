<?php


namespace T2\Streams\Stream;


use T2\Streams\Exception\EndOfStream;

class ArrayStreamTest extends \PHPUnit_Framework_TestCase
{
    public function testItsWorking()
    {
        $array = [10, 20, 'zxc'];
        $stream = new ArrayStream($array);

        $this->assertInstanceOf(StreamInterface::class, $stream);
        $this->assertEquals(10, $stream->getCurrent());
        $this->assertEquals(20, $stream->getCurrent());
        $this->assertEquals('zxc', $stream->getCurrent());

        $this->expectException(EndOfStream::class);
        $stream->getCurrent();
    }
}
