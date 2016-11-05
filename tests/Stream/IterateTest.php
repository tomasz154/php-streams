<?php


namespace T2\Streams\Stream;

class IterateTest extends \PHPUnit_Framework_TestCase
{
    public function testNumbers()
    {
        $stream = new Iterate(10, function ($current) {
            return $current + 2;
        });

        $this->assertEquals(10, $stream->getCurrent());
        $this->assertEquals(12, $stream->getCurrent());
        $this->assertEquals(14, $stream->getCurrent());
    }

    public function testString()
    {
        $stream = new Iterate('A', function ($current) {
            return $current . '*';
        });

        $this->assertEquals('A', $stream->getCurrent());
        $this->assertEquals('A*', $stream->getCurrent());
        $this->assertEquals('A**', $stream->getCurrent());
    }

    public function testNext()
    {
        $stream = new Iterate(10, function ($current) {
            return $current + 2;
        });

        $this->assertEquals(10, $stream->getCurrent());
        $stream->next();
        $this->assertEquals(14, $stream->getCurrent());
    }
}
