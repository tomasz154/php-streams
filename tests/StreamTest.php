<?php


namespace T2\Streams\Tests;


use T2\Streams\Operation\Filter;
use T2\Streams\Operation\Limit;
use T2\Streams\Operation\Map;
use T2\Streams\Operation\Skip;
use T2\Streams\Operation\Sorted;
use T2\Streams\Stream;
use T2\Streams\Stream\ArrayStream;
use T2\Streams\Stream\Iterate;
use T2\Streams\Stream\IteratorStream;

class StreamTest extends \PHPUnit_Framework_TestCase
{
    public function testFactoryMethods()
    {
        $iterate = Stream::iterate(1, function () {
        });
        $this->assertAttributeInstanceOf(Iterate::class, 'stream', $iterate);
        $this->assertInstanceOf(Stream::class, $iterate);

        $array = Stream::fromArray([]);
        $this->assertAttributeInstanceOf(ArrayStream::class, 'stream', $array);
        $this->assertInstanceOf(Stream::class, $array);

        $iterator = Stream::fromIterator(new \ArrayIterator());
        $this->assertAttributeInstanceOf(IteratorStream::class, 'stream', $iterator);
        $this->assertInstanceOf(Stream::class, $iterator);
    }

    public function testOperationMethods()
    {
        $stream = Stream::fromArray([]);

        $limit = $stream->limit(1);
        $this->assertInstanceOf(Stream::class, $limit);
        $this->assertAttributeInstanceOf(Limit::class, 'stream', $limit);


        $skip = $stream->skip(1);
        $this->assertInstanceOf(Stream::class, $skip);
        $this->assertAttributeInstanceOf(Skip::class, 'stream', $skip);


        $map = $stream->map(function () {
        });
        $this->assertInstanceOf(Stream::class, $map);
        $this->assertAttributeInstanceOf(Map::class, 'stream', $map);


        $filter = $stream->filter(function () {
        });
        $this->assertInstanceOf(Stream::class, $filter);
        $this->assertAttributeInstanceOf(Filter::class, 'stream', $filter);

        $sorted = $stream->sorted(function () {
        });
        $this->assertInstanceOf(Stream::class, $sorted);
        $this->assertAttributeInstanceOf(Sorted::class, 'stream', $sorted);
    }

    public function testTerminalOperationMethods()
    {
        $this->assertEquals(106, Stream::fromArray([1, 2, 3])->reduce(100, function ($carry, $item) {
            return $carry + $item;
        }));

        $this->assertEquals([1, 2, 3], Stream::fromArray([1, 2, 3])->toArray());

        $this->assertEquals([1, 2, 3], iterator_to_array(Stream::fromArray([1, 2, 3])->toGenerator()));

        $this->assertEquals(1, Stream::fromArray([1, 2, 3])->findFirst());

        $this->assertEquals(6, Stream::fromArray([1, 2, 3])->sum());

        $this->assertEquals(123, Stream::fromArray([1, 2, 3])->concat());
    }
}