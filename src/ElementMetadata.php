<?php

namespace DTL\ConsoleCanvas;

use Closure;

final class ElementMetadata
{
    public function __construct(private Element $element, private Position $position)
    {
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
}
