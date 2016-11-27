<?php


namespace T2\Streams\Tests\Stream;

use T2\Streams\Stream\Iterate;

class IterateTest extends \PHPUnit_Framework_TestCase
{
    public function testNumbers()
    {
        $stream = new Iterate(10, function ($current) {
            return $current + 2;
        });

        $this->assertFalse($stream->isBounded());

        $this->assertEquals(10, $stream->getCurrent());
        $stream->next();
        $this->assertEquals(14, $stream->getCurrent());
    }

    public function testString()
    {
        $stream = new Iterate('A', function ($current) {
            return $current . '*';
        });

        $this->assertFalse($stream->isBounded());

        $this->assertEquals('A', $stream->getCurrent());
        $this->assertEquals('A*', $stream->getCurrent());
        $this->assertEquals('A**', $stream->getCurrent());
    }
}
