<?php

namespace DTL\ConsoleCanvas\Tests\Unit\Stroke;

use DTL\ConsoleCanvas\Stroke;
use DTL\ConsoleCanvas\StrokeProperties;
use DTL\ConsoleCanvas\Stroke\Line;
use Generator;
use PHPUnit\Framework\TestCase;

class LineTest extends TestCase
{
        /**
         * @dataProvider provideStroke
         */
        public function testStroke(Stroke $stroke, StrokeProperties $properties, string $expected): void
        {
            self::assertEquals($expected, $stroke->paint($properties));
        }
        
        /**
         * @return Generator<mixed>
         */
        public function provideStroke(): Generator
        {
            yield [
                new Line(),
                new StrokeProperties(),
                '─',
            ];
            yield [
                new Line(),
                new StrokeProperties(angle: 90),
                '│',
            ];
            yield [
                new Line(),
                new StrokeProperties(angle: 45),
                '╱',
            ];
            yield [
                new Line(),
                new StrokeProperties(angle: 135),
                '╲',
            ];

            yield 'intersection north' => [
                new Line(),
                new StrokeProperties(intersection: true, angle: 0),
                '┴',
            ];

            yield 'intersection south' => [
                new Line(),
                new StrokeProperties(intersection: true, angle: 180),
                '┬',
            ];

            yield 'intersection east' => [
                new Line(),
                new StrokeProperties(intersection: true, angle: 90),
                '├',
            ];

            yield 'intersection west' => [
                new Line(),
                new StrokeProperties(intersection: true, angle: 270),
                '┤',
            ];
        }
}
