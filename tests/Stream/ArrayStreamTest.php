<?php


namespace T2\Streams\Tests\Stream;

use T2\Streams\Exception\EndOfStream;
use T2\Streams\Stream\ArrayStream;
use T2\Streams\Stream\StreamInterface;

class ArrayStreamTest extends \PHPUnit_Framework_TestCase
{
    public function testItsWorking()
    {
        $array = [10, 20, 'zxc'];
        $stream = new ArrayStream($array);

        $this->assertInstanceOf(StreamInterface::class, $stream);
        $this->assertEquals(10, $stream->getCurrent());
        $stream->next();
        $this->assertEquals('zxc', $stream->getCurrent());

        $this->expectException(EndOfStream::class);
        $stream->getCurrent();
    }
}
