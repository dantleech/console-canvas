<?php

namespace DTL\ConsoleCanvas\Stroke;

use DTL\ConsoleCanvas\Stroke;
use DTL\ConsoleCanvas\StrokeProperties;

final class Block implements Stroke
{
    public function paint(StrokeProperties $properties): string
    {
        return '▪';
    }
}
