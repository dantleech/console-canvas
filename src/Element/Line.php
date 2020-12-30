<?php

namespace DTL\ConsoleCanvas\Element;

class Line implements Element
{
    public function __construct(private float $angle, private float $length)
    {
    }
}
