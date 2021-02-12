<?php

namespace DTL\ConsoleCanvas;

use Closure;
use DTL\ConsoleCanvas\Stroke\Block;
use DTL\ConsoleCanvas\Stroke\Line;

final class ElementMetadata
{
    public function __construct(
        private Element $element,
        private Position $position,
        private ?Stroke $stroke = null,
        private ?Color $color = null,
        private ?Color $fillColor = null,
        private ?Stroke $fillStroke = null
    )
    {
    }

    public function color(): Color
    {
        return $this->color ?? Color::none();
    }

    public function fillColor(): Color
    {
        return $this->fillColor ?: Color::none();
    }

    public function fillStroke(): Stroke
    {
        return $this->fillStroke ?: new Block();
    }

    public function element(): Element
    {
        return $this->element;
    }

    public function position(): Position
    {
        return $this->position;
    }

    /**
     * @param Closure(Position): Position $closure
     */
    public function updatePosition(Closure $closure): void
    {
        $this->position = $closure($this->position);
    }

    /**
     * @param Closure(Element): Element $closure
     */
    public function updateElement(Closure $closure): void
    {
        $this->element = $closure($this->element);
    }

    public function setColor(Color $color): void
    {
        $this->color = $color;
    }

    public function stroke(): Stroke
    {
        return $this->stroke ?: new Block();
    }

    public function setStroke(Stroke $stroke): void
    {
        $this->stroke = $stroke;
    }

    public function setFillStroke(Stroke $stroke): void
    {
        $this->fillStroke = $stroke;
    }

    public function setFillColor(Color $color): void
    {
        $this->fillColor = $color;
    }
}
