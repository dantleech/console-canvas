<?php

namespace DTL\ConsoleCanvas\Element;

use DTL\ConsoleCanvas\Canvas;
use DTL\ConsoleCanvas\Element;
use DTL\ConsoleCanvas\ElementMetadata;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Brush;

final class Layer implements Element
{
    /**
     * @var array<string, ElementMetadata>
     */
    private $elements = [];

    public function __construct(private int $width, private int $height)
    {
    }

    public function addAt(Position $position, Element $element): void
    {
        $this->elements[spl_object_hash($element)] = new ElementMetadata($element, $position);
    }

    public function render(Brush $brush, Canvas $canvas): void
    {
        foreach ($this->elements as $metadata) {
            $childCanvas = new Canvas($this->width, $this->height);
            $metadata->element()->render(
                $brush->withColor($metadata->color())->withStroke($metadata->stroke()),
                $childCanvas
            );
            $canvas->mergeAt($metadata->position(), $childCanvas);
        }
    }

    public function meta(Element $circle): ElementMetadata
    {
        return $this->elements[spl_object_hash($circle)];
    }
}
