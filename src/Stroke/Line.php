<?php

namespace DTL\ConsoleCanvas\Stroke;

use DTL\ConsoleCanvas\Stroke;
use DTL\ConsoleCanvas\StrokeProperties;

final class Line implements Stroke
{
    private const CHARS = [
        '/',
        '|',
        '\\',
        '―'
    ];

    public function paint(StrokeProperties $properties): string
    {
        $angle = $properties->angle();
        $angle -= 22.5;
        $angle = $angle < 0 ? (360 - abs($angle)) : $angle;
        $angle = $angle % 360;
        $offset = intval($angle / (360 / 8));

        return self::CHARS[$offset % 4];
    }
}
