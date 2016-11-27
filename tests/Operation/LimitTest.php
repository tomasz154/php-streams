<?php


namespace T2\Streams\Tests\Operations;

use T2\Streams\Exception\EndOfStream;
use T2\Streams\Operation\Limit;
use T2\Streams\Stream\ArrayStream;
use T2\Streams\Stream\Iterate;

class LimitTest extends \PHPUnit_Framework_TestCase
{
    public function testNumbers()
    {
        $stream = new ArrayStream([1, 4, 10]);
        $limit = new Limit($stream, 2);

        $this->assertTrue($limit->isBounded());

        $this->assertEquals(1, $limit->getCurrent());
        $this->assertEquals(4, $limit->getCurrent());

        $this->expectException(EndOfStream::class);
        $limit->getCurrent();
    }

    public function testStrings()
    {
        $stream = new ArrayStream(['aa', 'bb', 'cc']);
        $limit = new Limit($stream, 2);
        $limit->next();

        $this->assertEquals('bb', $limit->getCurrent());

        $this->expectException(EndOfStream::class);
        $limit->getCurrent();
    }

    public function testEmptyStream()
    {
        $stream = new ArrayStream([]);
        $limit = new Limit($stream, 100);

        $this->expectException(EndOfStream::class);
        $limit->getCurrent();
    }

    public function testIterate()
    {
        $stream = new Iterate(10, function ($current) {
            return $current + 1;
        });
        $limit = new Limit($stream, 4);

        $this->assertFalse($stream->isBounded());
        $this->assertTrue($limit->isBounded());

        $this->assertEquals(10, $limit->getCurrent());
        $this->assertEquals(11, $limit->getCurrent());
        $this->assertEquals(12, $limit->getCurrent());
        $this->assertEquals(13, $limit->getCurrent());

        $this->expectException(EndOfStream::class);
        $limit->getCurrent();
    }
}
