<?php

namespace DTL\ConsoleCanvas\Tests\Unit\Element;

use Closure;
use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Canvas;
use DTL\ConsoleCanvas\Element\Container;
use DTL\ConsoleCanvas\Element\Path;
use DTL\ConsoleCanvas\Element\Text;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Stroke;
use DTL\ConsoleCanvas\Stroke\Char;
use Generator;
use PHPUnit\Framework\TestCase;

class ContainerTest extends ElementTestCase
{
    /**
     * @dataProvider provideRender
     */
    public function testRender(Closure $factory, string $expected): void
    {
        self::assertCanvas($expected, $factory());
    }

    /**
     * @return Generator<mixed>
     */
    public function provideRender(): Generator
    {
        yield [
            function () {
                $c = new Container(10, 10);
                $c->addAt(new Position(0, 0), new Text('Hello'));
                return $c;
            },
            <<<EOT
Hello.....
..........
..........
..........
..........
..........
..........
..........
..........
..........
EOT
        ];

        yield 'respects container boundary' => [
            function () {
                $c1 = new Container(10, 2);
                $c2 = new Container(3, 2);
                $c2->addAt(new Position(0, 0), new Text('Hello Hello Hello'));
                $c1->addAt(new Position(0, 0), $c2);
                return $c1;
            },
            <<<EOT
Hell......
..........
EOT
        ];
    }
}
