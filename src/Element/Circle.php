<?php

namespace DTL\ConsoleCanvas\Element;

use DTL\ConsoleCanvas\Stroke\Block;
use DTL\ConsoleCanvas\Canvas;
use DTL\ConsoleCanvas\Color;
use DTL\ConsoleCanvas\Element;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Brush;

final class Circle implements Element
{
    public function __construct(private float $radius)
    {
    }

    public function render(Brush $stroke, Canvas $canvas): void
    {
        for ($d = 0; $d < 360; $d++) {

            $x = $this->radius * sin(M_PI * 2 * $d / 360) + $this->radius;
            $y = $this->radius * cos(M_PI * 2 * $d / 360) + $this->radius;

            $canvas->paint(new Position($x, $y), $stroke->withAngle($d));
        }
    }
}
