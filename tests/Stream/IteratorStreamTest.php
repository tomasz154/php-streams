<?php


namespace T2\Streams\Tests\Stream;


use T2\Streams\Exception\EndOfStream;
use T2\Streams\Stream\IteratorStream;
use T2\Streams\Stream\StreamInterface;

class IteratorStreamTest extends \PHPUnit_Framework_TestCase
{
    public function testItsWorking()
    {
        $array = [10, 20, 'zxc'];
        $stream = new IteratorStream(new \ArrayIterator($array));

        $this->assertFalse($stream->isBounded());

        $this->assertInstanceOf(StreamInterface::class, $stream);
        $this->assertEquals(10, $stream->getCurrent());
        $stream->next();
        $this->assertEquals('zxc', $stream->getCurrent());

        $this->expectException(EndOfStream::class);
        $stream->getCurrent();
    }
}
