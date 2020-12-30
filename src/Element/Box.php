<?php

namespace DTL\ConsoleCanvas\Element;

use DTL\ConsoleCanvas\Stroke\Block;
use DTL\ConsoleCanvas\Canvas;
use DTL\ConsoleCanvas\Color;
use DTL\ConsoleCanvas\Element;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Brush;

final class Box implements Element
{
    public function __construct(private int $size, private ?Color $color = null)
    {
    }

    public function render(Brush $stroke, Canvas $canvas): void
    {
        for ($x = 0; $x < $this->size; $x++) {
            for ($y = 0; $y < $this->size; $y++) {
                $canvas->paint(
                    new Position($x, $y),
                    $stroke
                );
            }
        }
    }
}
