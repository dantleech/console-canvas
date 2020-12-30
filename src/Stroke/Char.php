<?php

namespace DTL\ConsoleCanvas\Stroke;

use DTL\ConsoleCanvas\Stroke;
use DTL\ConsoleCanvas\StrokeProperties;

class Char implements Stroke
{
    public function __construct(private string $char)
    {
    }

    public function paint(StrokeProperties $properties): string
    {
        return $this->char;
    }
}
