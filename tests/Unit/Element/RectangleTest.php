<?php

namespace DTL\ConsoleCanvas\Tests\Unit\Element;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Canvas;
use DTL\ConsoleCanvas\Element\Line;
use DTL\ConsoleCanvas\Element\Path;
use DTL\ConsoleCanvas\Element\Rectangle;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Stroke;
use DTL\ConsoleCanvas\Stroke\Char;
use Generator;
use PHPUnit\Framework\TestCase;

class RectangleTest extends ElementTestCase
{
    /**
     * @dataProvider provideRender
     */
    public function testRender(Rectangle $rectangle, string $expected): void
    {
        self::assertCanvas($expected, $rectangle);
    }

    /**
     * @return Generator<mixed>
     */
    public function provideRender(): Generator
    {
        yield 'rectangle' => [
            new Rectangle(width: 2, height: 3),
            <<<EOT
xxx
x.x
x.x
xxx
EOT
        ];
    }
}
