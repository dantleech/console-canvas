<?php

namespace DTL\ConsoleCanvas\Tests\Unit\Element;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Canvas;
use DTL\ConsoleCanvas\Element\Path;
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
            Path::fromPairs([
                [ 0, 0 ], [ 10, 0 ]
            ]),
            'xxxxxxxxxx'
        ];
        yield [
            Path::fromPairs([
                [ 0, 0 ], [ 0, 4 ]
            ]),
            <<<EOT
x
x
x
x
EOT
        ];
        yield 'diagnonal' => [
            Path::fromPairs([
                [ 0, 0 ], [ 4, 4 ]
            ]),
            <<<EOT
x....
 x...
  x..
   x.
    x
EOT
        ];
        yield 'multiple points 1' => [
            Path::fromPairs([
                [ 0, 0 ], [ 4, 4 ],

                [ 0, 4 ], [ 4, 4 ],
            ]),
            <<<EOT
x....
 x...
  x..
   x.
xxxxx
EOT
        ];

        yield 'multiple points 2' => [
            Path::fromPairs([
                [ 0, 0 ], [ 4, 4 ],

                [ 0, 4 ], [ 4, 4 ],
                [ 0, 0 ], [ 0, 4 ],
            ]),
            <<<EOT
x....
xx...
x x..
x  x.
xxxxx
EOT
        ];

        yield 'out of range' => [
            Path::fromPairs([
                [ -5, 1 ], [ 4, 1 ],
            ]),
            <<<EOT
.....
xxxxx
.....
.....
.....
EOT
        ];
    }
}
