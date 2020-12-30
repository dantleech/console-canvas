<?php

namespace DTL\ConsoleCanvas\Brush;

use DTL\ConsoleCanvas\Brush;

class Char implements Brush
{
    public function __construct(private string $char)
    {
    }

    public function render(): string
    {
        return $this->char;
    }
}
