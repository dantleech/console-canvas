<?php

namespace DTL\ConsoleCanvas\Element;

use DTL\ConsoleCanvas\Canvas;
use DTL\ConsoleCanvas\Element;
use DTL\ConsoleCanvas\ElementMetadata;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Brush;

final class Container implements Element
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
            assert($metadata instanceof ElementMetadata);
            $childCanvas = new Canvas($this->width, $this->height);

            $brush = $brush->withColor($metadata->color());
            $brush = $brush->withStroke($metadata->stroke());

            $fill = $brush->fill();
            $fill = $fill->withColor($metadata->fillColor());
            $fill = $fill->withStroke($metadata->fillStroke());

            $brush = $brush->withFill($fill);

            $metadata->element()->render(
                $brush,
                $childCanvas
            );

            $canvas->mergeAt($metadata->position(), $childCanvas);
        }
    }

    public function meta(Element $circle): ElementMetadata
    {
        return $this->elements[spl_object_hash($circle)];
    }

    private function applyToBrush(ElementMetadata $metadata, Brush $brush, bool $fill): Brush
    {
        return $brush
            ->withColor($fill ? $metadata->fillColor() : $metadata->color())
            ->withStroke($metadata->stroke());
    }
}
