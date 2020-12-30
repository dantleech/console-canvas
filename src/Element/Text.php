<?php

namespace DTL\ConsoleCanvas\Element;

use DTL\ConsoleCanvas\Stroke\Char;
use DTL\ConsoleCanvas\Canvas;
use DTL\ConsoleCanvas\Element;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Brush;

final class Text implements Element
{
    public function __construct(private string $text)
    {
    }

    public function render(Brush $stroke, Canvas $canvas): void
    {
        foreach (mb_str_split($this->text) as $x => $char) {
            $canvas->paint(new Position(x: $x, y: 0), $stroke->withStroke(new Char($char)));
        }
    }
}
