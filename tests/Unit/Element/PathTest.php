<?php

namespace DTL\ConsoleCanvas\Tests\Unit\Element;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Canvas;
use DTL\ConsoleCanvas\Element\Path;
use DTL\ConsoleCanvas\Positions;
use DTL\ConsoleCanvas\Stroke;
use DTL\ConsoleCanvas\Stroke\Char;
use Generator;
use PHPUnit\Framework\TestCase;

class PathTest extends ElementTestCase
{
    /**
     * @dataProvider provideRender
     */
    public function testRender(Path $path, string $expected): void
    {
        self::assertCanvas($expected, $path);
    }

    /**
     * @return Generator<mixed>
     */
    public function provideRender(): Generator
    {
        yield [
            new Path(Positions::fromPairs([
                [ 0, 0 ], [ 10, 0 ]
            ])),
            'xxxxxxxxxx'
        ];
        yield [
            new Path(Positions::fromPairs([
                [ 0, 0 ], [ 0, 4 ]
            ])),
            <<<EOT
x
x
x
x
EOT
        ];
        yield 'diagnonal' => [
            new Path(Positions::fromPairs([
                [ 0, 0 ], [ 4, 4 ]
            ])),
            <<<EOT
x....
.x...
..x..
...x.
....x
EOT
        ];
        yield 'triangle' => [
            new Path(Positions::fromPairs([
                [ 0, 0 ], [ 3, 0 ], [ 3, 3 ], [ 0, 0 ]

            ])),
            <<<EOT
xxxx.
.x.x.
..xx.
...x.
EOT
        ];

        yield 'box' => [
            new Path(Positions::fromPairs([
                [ 0, 0 ],
                [ 0, 4 ],
                [ 4, 4 ],
                [ 4, 0 ],
                [ 0, 0 ],
            ]),),
            <<<EOT
xxxxx
x...x
x...x
x...x
xxxxx
EOT
        ];
    }
}
