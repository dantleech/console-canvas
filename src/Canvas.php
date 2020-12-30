<?php

namespace DTL\ConsoleCanvas;

class Canvas
{
    /**
     * @var array<int, array<int, Cell>>
     */
    private $grid = [];

    public function __construct(private int $width, private int $height)
    {
    }

    public function paint(Position $position, Brush $brush, Color $color = null)
    {
        $color = $color ?? Color::none();
        $this->grid[(int)round($position->y())][(int)round($position->x())] = new Cell($brush->render(), $color);
    }

    public function mergeAt(Position $position, Canvas $canvas): void
    {
        foreach ($canvas->grid as $y => $row) {
            foreach ($row as $x => $char) {
                $this->grid[$y + $position->y()][$x + $position->x()] = $char;
            }
        }
    }

    public function render(): string
    {
        $output = [];
        $currentColor = null;
        for ($y = 0; $y < $this->height; $y++) {
            $line = '';

            for ($x = 0; $x < $this->width; $x++) {

                if (!isset($this->grid[$y][$x])) {
                    $line .= ' ';
                    continue;
                }
                $cell = $this->grid[$y][$x];

                if (null === $currentColor || $cell->color() != $currentColor) {
                    $currentColor = $cell->color();
                    $line .= $currentColor->ansiCode();
                }

                $line .= $cell->char();
            }

            $output[] = $line;
        }

        $output[] = "\x1b[" . $this->height . "A";

        return implode("\n", $output);
    }

    public function clear(): void
    {
        $this->grid = [];
    }
}
