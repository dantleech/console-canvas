<?php

namespace DTL\ConsoleCanvas;

use DTL\ConsoleCanvas\Brush;

interface Element
{
    public function render(Brush $brush, Canvas $canvas): void;
}
