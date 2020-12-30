<?php

namespace DTL\ConsoleCanvas;

interface Stroke
{
    public function paint(StrokeProperties $properties): string;
}
