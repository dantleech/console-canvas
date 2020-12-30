<?php

namespace DTL\ConsoleCanvas\Tests\Unit\Element;

use DTL\ConsoleCanvas\Element\Series;
use Generator;
use PHPUnit\Framework\TestCase;

class SeriesTest extends ElementTestCase
{
    /**
     * @dataProvider provideRender
     */
    public function testRender(Series $path, string $expected): void
    {
        self::assertCanvas($expected, $path);
    }

    /**
     * @return Generator<mixed>
     */
    public function provideRender(): Generator
    {
        yield [
            new Series([
                0, 1, 2, 1, 0, 1, 2, 1, 0
            ], density: 5),
            <<<EOT
x...x...x
.x.x.x.x.
..x...x..
EOT
        ];
    }
}
