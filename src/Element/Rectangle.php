<?php

namespace DTL\ConsoleCanvas\Element;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Canvas;
use DTL\ConsoleCanvas\Element;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Positions;

final class Rectangle implements Element
{
    public function __construct(private float $width, private float $height)
    {
    }

    public function render(Brush $brush, Canvas $canvas): void
    {
        $path = new Path(new Positions([
            new Position(0, 0),
            new Position(0, $this->height),
            new Position($this->width, $this->height),
            new Position($this->width, 0),
            new Position(0, 0),
        ]));
        $path->render($brush, $canvas);
    }
}
