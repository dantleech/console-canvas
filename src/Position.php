<?php

namespace DTL\ConsoleCanvas;

final class Position
{
    public function __construct(private float $x, private float $y)
    {
    }

    public function scaleY(float $scale): self
    {
        return new self($this->x, $this->y * $scale);
    }

    public function x(): float
    {
        return $this->x;
    }

    public function y(): float
    {
        return $this->y;
    }
}
