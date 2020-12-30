<?php

namespace DTL\ConsoleCanvas;

final class Cell
{
    public function __construct(private string $char, private Color $color)
    {
    }

    public function char(): string
    {
        return $this->char;
    }

    public function color(): Color
    {
        return $this->color;
    }
}
