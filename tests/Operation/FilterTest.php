<?php


namespace T2\Streams\Tests\Operations;


use T2\Streams\Exception\EndOfStream;
use T2\Streams\Operation\Filter;
use T2\Streams\Stream\ArrayStream;

class FilterTest extends \PHPUnit_Framework_TestCase
{
    public function testItsWorking()
    {
        $stream = new ArrayStream([1, 4, 4, 8, 10]);
        $filter = new Filter($stream, function ($item) {
            return $item % 4 == 0;
        });

        $this->assertEquals(4, $filter->getCurrent());
        $filter->next();
        $this->assertEquals(8, $filter->getCurrent());

        $this->expectException(EndOfStream::class);
        $filter->getCurrent();
    }

    public function testEmptyStream()
    {
        $stream = new ArrayStream([]);
        $filter = new Filter($stream, function ($item) {
            return true;
        });

        $this->expectException(EndOfStream::class);
        $filter->getCurrent();
    }
}