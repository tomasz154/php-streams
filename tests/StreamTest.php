<?php


namespace T2\Streams;


class StreamTest extends \PHPUnit_Framework_TestCase
{
    public function testFactoryMethods()
    {
        $this->assertInstanceOf(Stream::class, Stream::iterate(1, function () {
        }));

        $this->assertInstanceOf(Stream::class, Stream::fromArray([]));
        $this->assertInstanceOf(Stream::class, Stream::fromIterator(new \ArrayIterator()));
    }

    public function testOperationMethods()
    {
        $stream = Stream::fromArray([]);

        $this->assertInstanceOf(Stream::class, $stream->limit(1));
        $this->assertInstanceOf(Stream::class, $stream->skip(1));
        $this->assertInstanceOf(Stream::class, $stream->map(function () {
        }));
        $this->assertInstanceOf(Stream::class, $stream->filter(function () {
        }));
    }

    public function testTerminalOperationMethods()
    {
        $this->assertEquals(106, Stream::fromArray([1, 2, 3])->reduce(100, function ($carry, $item) {
            return $carry + $item;
        }));

        $this->assertEquals([1, 2, 3], Stream::fromArray([1, 2, 3])->toArray());

        $this->assertEquals(1, Stream::fromArray([1, 2, 3])->findFirst());

        $this->assertEquals(6, Stream::fromArray([1, 2, 3])->sum());

        $this->assertEquals(123, Stream::fromArray([1, 2, 3])->concat());
    }
}