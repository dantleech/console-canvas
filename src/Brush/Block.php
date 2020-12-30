<?php

namespace DTL\ConsoleCanvas\Brush;

use DTL\ConsoleCanvas\Brush;

final class Block implements Brush
{
    public function render(): string
    {
        return '▪';
    }
}
