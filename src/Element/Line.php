<?php

namespace DTL\ConsoleCanvas\Element;

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Canvas;
use DTL\ConsoleCanvas\Element;
use DTL\ConsoleCanvas\Position;

class Line implements Element
{
    public function __construct(
        private Position $start,
        private Position $end,
        private int $density = 100
    )
    {
    }

    public function render(Brush $brush, Canvas $canvas): void
    {
        $xSeries = $this->series($this->start->x(), $this->end->x());
        $ySeries = $this->series($this->start->y(), $this->end->y());

        $lastX = null;
        $lastY = null;

        $angle = -atan2(
            $this->end->y() - $this->start->y(),
            $this->end->x() - $this->start->x()
        ) * 180 / M_PI;

        $brush = $brush->withAngle($angle);

        foreach ($xSeries as $index => $x) {
            $y = $ySeries[$index];

            $canvas->paint(new Position($x, $y), $brush);
        }
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
