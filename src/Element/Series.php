<?php

namespace DTL\ConsoleCanvas\Element;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Canvas;
use DTL\ConsoleCanvas\Element;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Positions;

final class Series implements Element
{
    public function __construct(private array $values, private int $density = 10, private int $step = 1)
    {
    }

    public function render(Brush $brush, Canvas $canvas): void
    {
        $startY = null;
        $positions = [];
        $x = 0;
        foreach (array_values($this->values) as $y) {
            $positions[] = new Position($x, $y,);
            $x += $this->step;
        }

        (new Path(new Positions($positions), density: $this->density))->render($brush, $canvas);
    }

    public function withValues(array $values): self
    {
        $new = clone $this;
        $new->values = $values;
        return $new;
    }
}
