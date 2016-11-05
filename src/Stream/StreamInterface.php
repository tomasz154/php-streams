<?php


namespace T2\Streams\Stream;


interface StreamInterface
{
    public function getCurrent();
    public function next();
}