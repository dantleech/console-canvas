<?php

namespace DTL\ConsoleCanvas;

class Brushes
{
    public function __construct(private Brush $stroke, private Brush $fill)
    {
    }

    public function fill(): Brush
    {
        return $this->fill;
    }

    public function stroke(): Brush
    {
        return $this->stroke;
    }
}
