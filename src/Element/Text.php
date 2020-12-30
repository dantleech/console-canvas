<?php

namespace DTL\ConsoleCanvas\Element;

use DTL\ConsoleCanvas\Brush\Char;
use DTL\ConsoleCanvas\Canvas;
use DTL\ConsoleCanvas\Element;
use DTL\ConsoleCanvas\Position;

final class Text implements Element
{
    public function __construct(private string $text)
    {
    }

    public function render(Canvas $canvas): void
    {
        foreach (mb_str_split($this->text) as $x => $char) {
            $canvas->paint(new Position(x: $x, y: 0), new Char($char));
        }
    }
}
