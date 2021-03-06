<?php

namespace DTL\ConsoleCanvas\Tests\Unit\Element;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Canvas;
use DTL\ConsoleCanvas\Element;
use DTL\ConsoleCanvas\Stroke;
use DTL\ConsoleCanvas\Stroke\Char;
use PHPUnit\Framework\TestCase;

class ElementTestCase extends TestCase
{
    protected static function assertCanvas(string $expected, Element $element, ?Brush $brush = null): void
    {
        $canvas = Canvas::fromTextDimensions($expected);
        $brush = $brush ?? Brush::default()->withStroke(new Char('x'));
        $element->render($brush, $canvas);

        $rendered = $canvas->render();

        // temporarily strip ANSI codes until palette is implemented
        $expected = str_replace('.', ' ', $expected);
        $rendered = preg_replace('#\\x1b[[][^A-Za-z]*[A-Za-z]#', '', $rendered);
        if ($expected !== $rendered) {
            self::fail(sprintf(
                "Actual:\n---\n%s\n----\ndid not match expected:\n----\n%s\n----",
                $rendered,
                $expected,
            ));
        }
        self::assertEquals($expected, $rendered);
    }
}
