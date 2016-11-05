<?php


namespace Operation;


use T2\Streams\Exception\EndOfStream;
use T2\Streams\Operation\Limit;
use T2\Streams\Stream\ArrayStream;

class LimitTest extends \PHPUnit_Framework_TestCase
{
    public function testNumbers()
    {
        $stream = new ArrayStream([1, 4, 10]);
        $limit = new Limit($stream, 2);

        $this->assertEquals(1, $limit->getCurrent());
        $this->assertEquals(4, $limit->getCurrent());

        $this->expectException(EndOfStream::class);
        $limit->getCurrent();
    }

    public function testStrings()
    {
        $stream = new ArrayStream(['aa', 'bb']);
        $limit = new Limit($stream, 1);

        $this->assertEquals('aa', $limit->getCurrent());

        $this->expectException(EndOfStream::class);
        $limit->getCurrent();
    }

    public function testNext()
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
}