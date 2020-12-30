<?php

namespace DTL\ConsoleCanvas;

use DTL\ConsoleCanvas\Brush;

interface Element
{
    public function render(Brush $stroke, Canvas $canvas): void;
}
