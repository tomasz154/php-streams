<?php


namespace T2\Streams\Tests\Operations;


use T2\Streams\Exception\EndOfStream;
use T2\Streams\Exception\InvalidArgumentException;
use T2\Streams\Operation\Sorted;
use T2\Streams\Stream\ArrayStream;
use T2\Streams\Stream\StreamInterface;

class SortedTest extends \PHPUnit_Framework_TestCase
{
    public function testNumbers()
    {
        $stream = new ArrayStream([2, 3, 1]);
        $sorted = new Sorted($stream);

        $this->assertEquals($stream->isBounded(), $sorted->isBounded());

        $this->assertEquals(1, $sorted->getCurrent());
        $this->assertEquals(2, $sorted->getCurrent());
        $this->assertEquals(3, $sorted->getCurrent());

        $this->expectException(EndOfStream::class);
        $sorted->getCurrent();
    }

    public function testNext()
    {
        $stream = new ArrayStream([2, 3, 1]);
        $sorted = new Sorted($stream);

        $this->assertEquals($stream->isBounded(), $sorted->isBounded());

        $this->assertEquals(1, $sorted->getCurrent());
        $sorted->next();
        $this->assertEquals(3, $sorted->getCurrent());

        $this->expectException(EndOfStream::class);
        $sorted->getCurrent();
    }

    public function testStrings()
    {
        $stream = new ArrayStream(['q', 'w', 'e']);
        $sorted = new Sorted($stream);

        $this->assertEquals('e', $sorted->getCurrent());
        $this->assertEquals('q', $sorted->getCurrent());
        $this->assertEquals('w', $sorted->getCurrent());

        $this->expectException(EndOfStream::class);
        $sorted->getCurrent();
    }

    public function testEmptyStream()
    {
        $stream = new ArrayStream([]);
        $sorted = new Sorted($stream, function ($item) {
            return true;
        });

        $this->expectException(EndOfStream::class);
        $sorted->getCurrent();
    }

    public function testUnbounded()
    {
        $stream = $this->prophesize(StreamInterface::class);
        $stream->isBounded()->willReturn(false);

        $this->expectException(InvalidArgumentException::class);
        $reduce = new Sorted($stream->reveal(), 0, function ($carry, $item) {
            return $carry + $item;
        });
    }
}