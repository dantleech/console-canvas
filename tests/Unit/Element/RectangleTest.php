<?php

namespace DTL\ConsoleCanvas\Tests\Unit\Element;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Canvas;
use DTL\ConsoleCanvas\Element\Path;
use DTL\ConsoleCanvas\Element\Rectangle;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Stroke;
use DTL\ConsoleCanvas\Stroke\Block;
use DTL\ConsoleCanvas\Stroke\Char;
use DTL\ConsoleCanvas\Stroke\Line;
use Generator;
use PHPUnit\Framework\TestCase;

class RectangleTest extends ElementTestCase
{
    /**
     * @dataProvider provideRender
     */
    public function testRender(Rectangle $rectangle, Brush $brush, string $expected): void
    {
        self::assertCanvas($expected, $rectangle, $brush);
    }

    /**
     * @return Generator<mixed>
     */
    public function provideRender(): Generator
    {
        yield 'rectangle' => [
            new Rectangle(width: 2, height: 3),
            Brush::default()->withStroke(new Block()),
            <<<EOT
███
█ █
█ █
███
EOT
        ];

        yield 'rectangle with border' => [
            new Rectangle(width: 10, height: 2),
            Brush::default()->withStroke(new Line()),
            <<<EOT
┌─────────┐
│         │
└─────────┘
EOT
        ];

        yield 'filled rectangle' => [
            new Rectangle(width: 10, height: 2, fill: true),
            Brush::default()->withStroke(new Block()),
            <<<EOT
███████████
███████████
███████████
EOT
        ];

        yield 'filled rectangle with fill brush' => [
            new Rectangle(width: 10, height: 2, fill: true),
            Brush::default()->withStroke(new Line()),
            <<<EOT
┌─────────┐
│█████████│
└─────────┘
EOT
        ];
    }
}
