<?php

namespace DTL\ConsoleCanvas;

use DTL\ConsoleCanvas\Brush;

class Canvas
{
    /**
     * @var array<int, array<int, Cell>>
     */
    private $grid = [];

    private bool $needsReset = false;

    public function __construct(
        private int $width,
        private int $height,
        private float $scaleY = 1.0,
        private float $scaleX = 1.0
    )
    {
    }

    public function paint(Position $position, Brush $stroke): void
    {
        $this->putCell($position, new Cell($stroke->render(), $stroke->color()));
    }

    public function mergeAt(Position $position, Canvas $canvas): void
    {
        foreach ($canvas->grid as $y => $row) {
            foreach ($row as $x => $cell) {
                $this->putCell(
                    $position->withX($position->x() + $x)->withY($position->y() + $y),
                    $cell
                );
            }
        }
    }

    public function render(): string
    {
        $output = [];
        if ($this->needsReset) {
            $output[] = "\x1b[" . $this->height . "A";
        }

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

        $this->needsReset = true;

        return implode("\n", $output);
    }

    public function clear(): void
    {
        $this->grid = [];
    }

    private function putCell(Position $position, Cell $cell): void
    {
        $this->grid[(int)round($position->y() * $this->scaleY)][(int)round($position->x() * $this->scaleX)] = $cell;
    }

    public static function fromTextDimensions(string $expected): self
    {
        $lines = explode("\n", $expected);
        $length = 0;
        foreach ($lines as $line) {
            if (($lineLength = mb_strlen($line)) > $length) {
                $length = $lineLength;
            }
        }

        return new self($length, count($lines));
    }
}
