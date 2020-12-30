<?php

namespace DTL\ConsoleCanvas;

interface Element
{
    public function render(Canvas $canvas): void;
}
