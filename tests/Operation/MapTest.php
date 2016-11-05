<?php


namespace T2\Streams\Tests\Operations;


use T2\Streams\Exception\EndOfStream;
use T2\Streams\Operation\Map;
use T2\Streams\Stream\ArrayStream;

class MapTest extends \PHPUnit_Framework_TestCase
{
    public function testNumbers()
    {
        $stream = new ArrayStream([1, 4, 10]);
        $map = new Map($stream, function ($item) {
            return $item * 2;
        });

        $this->assertEquals($stream->isBounded(), $map->isBounded());

        $this->assertEquals(2, $map->getCurrent());
        $map->next();
        $this->assertEquals(20, $map->getCurrent());

        $this->expectException(EndOfStream::class);
        $map->getCurrent();
    }

    public function testStrings()
    {
        $stream = new ArrayStream(['aa', 'bb', 'xyz']);
        $map = new Map($stream, function ($item) {
            return '*' . $item . '*';
        });

        $this->assertEquals('*aa*', $map->getCurrent());
        $map->next();
        $this->assertEquals('*xyz*', $map->getCurrent());

        $this->expectException(EndOfStream::class);
        $map->getCurrent();
    }

    public function testBuiltinFunction()
    {
        $stream = new ArrayStream(['aa', 'bb']);
        $map = new Map($stream, 'strtoupper');

        $this->assertEquals('AA', $map->getCurrent());
        $this->assertEquals('BB', $map->getCurrent());

        $this->expectException(EndOfStream::class);
        $map->getCurrent();
    }

    public function testEmptyStream()
    {
        $stream = new ArrayStream([]);
        $map = new Map($stream, function ($item) {
            return $item;
        });

        $this->expectException(EndOfStream::class);
        $map->getCurrent();
    }
}