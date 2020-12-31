<?php

namespace DTL\ConsoleCanvas\Element;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Canvas;
use DTL\ConsoleCanvas\Element;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Positions;

final class Path implements Element
{
    public function __construct(private Positions $positions, private int $density = 10)
    {
    }

    public function render(Brush $brush, Canvas $canvas): void
    {
        $start = null;
        $plots = [];
        foreach ($this->positions as $end) {
            if ($start === null) {
                $start = $end;
                continue;
            }

            (new Line($start, $end, density: $this->density))->render($brush, $canvas);

            $start = $end;
        }
    }
}
