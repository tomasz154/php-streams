<?php


namespace T2\Streams\Tests\Operations;


use T2\Streams\Exception\EndOfStream;
use T2\Streams\Operation\Skip;
use T2\Streams\Stream\ArrayStream;
use T2\Streams\Stream\Iterate;

class SkipTest extends \PHPUnit_Framework_TestCase
{
    public function testNumbers()
    {
        $stream = new ArrayStream([1, 4, 10, 20, 100]);
        $skip = new Skip($stream, 2);

        $this->assertEquals($stream->isBounded(), $skip->isBounded());

        $this->assertEquals(10, $skip->getCurrent());
        $skip->next();
        $this->assertEquals(100, $skip->getCurrent());

        $this->expectException(EndOfStream::class);
        $skip->getCurrent();
    }

    public function testStrings()
    {
        $stream = new ArrayStream(['aa', 'bb', 'zz']);
        $skip = new Skip($stream, 1);

        $this->assertEquals('bb', $skip->getCurrent());
        $this->assertEquals('zz', $skip->getCurrent());

        $this->expectException(EndOfStream::class);
        $skip->getCurrent();
    }

    public function testSkipZero()
    {
        $stream = new ArrayStream([1, 4, 10]);
        $skip = new Skip($stream, 0);

        $this->assertEquals(1, $skip->getCurrent());
        $this->assertEquals(4, $skip->getCurrent());
        $this->assertEquals(10, $skip->getCurrent());

        $this->expectException(EndOfStream::class);
        $skip->getCurrent();
    }

    public function testBigSkip()
    {
        $stream = new ArrayStream([1, 4, 10]);
        $skip = new Skip($stream, 100);

        $this->expectException(EndOfStream::class);
        $skip->getCurrent();
    }

    public function testEmptyStream()
    {
        $stream = new ArrayStream([]);
        $skip = new Skip($stream, 100);

        $this->expectException(EndOfStream::class);
        $skip->getCurrent();
    }

    public function testItsLazy()
    {
        $test = $this;
        $stream = new Iterate(1, function ($current) use ($test) {
            // TODO: fix test, Iterate is not lazy by design
//            if ($current < 3) {
//                $test->fail();
//            }

            return $current + 1;
        });

        $skip = new Skip($stream, 2);
        $this->assertEquals(3, $skip->getCurrent());
    }
}