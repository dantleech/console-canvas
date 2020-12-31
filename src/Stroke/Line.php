<?php

namespace DTL\ConsoleCanvas\Stroke;

use DTL\ConsoleCanvas\Stroke;
use DTL\ConsoleCanvas\StrokeProperties;

final class Line implements Stroke
{
    private const CHARS = ['╱', '│', '╲', '─'];

    private const INTERSECTIONS = ['┴', '└', '├', '┌', '┬', '┐', '┤', '┘'];

    public function paint(StrokeProperties $properties): string
    {
        $angle = $properties->angle();

        if ($properties->intersection()) {
            $offset = intval($angle / (360 / 8));
            return self::INTERSECTIONS[$offset % 8];
        }

        // offset 
        $angle -= 22.5;
        $angle = $angle < 0 ? (360 - abs($angle)) : $angle;
        $angle = $angle % 360;
        $offset = intval($angle / (360 / 8));
        return self::CHARS[$offset % 4];
    }
}
