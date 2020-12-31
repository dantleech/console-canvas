<?php

namespace DTL\ConsoleCanvas\Element;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Canvas;
use DTL\ConsoleCanvas\Element;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Positions;

final class Rectangle implements Element
{
    public function __construct(private float $width, private float $height, private bool $fill = false)
    {
    }

    public function render(Brush $brush, Canvas $canvas): void
    {
        $this->renderStroke($brush, $canvas);
        $this->renderFill($brush, $canvas);
        $this->renderCorners($brush, $canvas);
    }

    private function renderStroke(Brush $brush, Canvas $canvas): void
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

    private function renderFill(Brush $brush, Canvas $canvas): void
    {
        if (!$this->fill) {
            return;
        }

        if ($this->height < 2) {
            return;
        }

        for ($y = 1; $y < $this->height; $y++) {
            $line = new Line(new Position(1, $y), new Position($this->width - 1, $y));
            $line->render($brush->fill(), $canvas);
        }
    }

    private function renderCorners(Brush $brush, Canvas $canvas): void
    {
        $brush = $brush->asIntersection();
        $angle = 135; // corner direction south-east
        foreach ([
            new Position(0, 0),
            new Position(0, $this->height),
            new Position($this->width, $this->height),
            new Position($this->width, 0),
        ] as $index => $position) {
        
            $canvas->paint($position, $brush->withAngle($angle));
        
            // rotate 90 degrees to next corner
            $angle = abs($angle + 270) % 360;
        }
    }
}
