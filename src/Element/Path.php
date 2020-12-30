<?php

namespace DTL\ConsoleCanvas\Element;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Canvas;
use DTL\ConsoleCanvas\Element;
use DTL\ConsoleCanvas\Position;

final class Path implements Element
{
    /**
     * @param list<Position> $positions
     */
    public function __construct(private array $positions, private int $density = 10)
    {
    }

    public function render(Brush $brush, Canvas $canvas): void
    {
        $start = null;
        $plots = [];
        foreach ($this->positions as $end) {
            if ($start === null) {
                $start = $end;
                continue;
            }

            $xSeries = $this->series($start->x(), $end->x());
            $ySeries = $this->series($start->y(), $end->y());

            foreach ($xSeries as $index => $x) {
                $canvas->paint(new Position($x, $ySeries[$index]), $brush);
            }

            $start = $end;
        }
    }

    public static function fromPairs(array $pairs): self
    {
        return new self(array_map(function (array $pair) {
            return new Position($pair[0], $pair[1]);
        }, $pairs));
    }

    private function series(float $start, float $end): array
    {
        $delta = ($end - $start) / $this->density;

        return array_reduce(range(0, $this->density), function (array $points, int $index) use ($start, $delta) {
            $points[] = $start + ($delta * $index);
            return $points;
        }, []);
    }
}
