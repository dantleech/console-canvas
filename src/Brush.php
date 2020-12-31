<?php

namespace DTL\ConsoleCanvas;

use DTL\ConsoleCanvas\Stroke\Block;
use DTL\ConsoleCanvas\Stroke\Char;
use DTL\ConsoleCanvas\Stroke;

final class Brush
{
    public function __construct(
        private Color $color,
        private float $angle = 0,
        private ?Stroke $stroke = null,
        private bool $intersection = false,
        private ?Brush $fill = null
    )
    {
    }

    public function fill(): self
    {
        if (null === $this->fill) {
            return $this;
        }

        return $this->fill;
    }

    public static function default(): self
    {
        return new self(Color::none());
    }

    public function color(): Color
    {
        return $this->color;
    }

    public function angle(): float
    {
        return $this->angle;
    }

    public function render(): string
    {
        return $this->asStroke()->paint(new StrokeProperties(
            angle: $this->angle,
            intersection: $this->intersection
        ));
    }

    public function withStroke(Stroke $stroke): self
    {
        $new = clone $this;
        $new->stroke = $stroke;

        return $new;
    }

    public function withColor(Color $color): self
    {
        $new = clone $this;
        $new->color = $color;

        return $new;
    }

    public function withAngle(float $degrees): self
    {
        $new = clone $this;
        $new->angle = $degrees;

        return $new;
    }

    public function withFill(Brush $brush): self
    {
        $new = clone $this;
        $new->fill = $brush;

        return $new;
    }

    public function asIntersection(): self
    {
        $new = clone $this;
        $new->intersection = true;
        return $new;
    }

    private function asStroke(): Stroke
    {
        return $this->stroke ?: new Block();
    }
}
