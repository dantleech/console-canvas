<?php

namespace DTL\ConsoleCanvas;

final class StrokeProperties
{
    public function __construct(private float $angle)
    {
    }

    public function angle(): float
    {
        return $this->angle;
    }
}
