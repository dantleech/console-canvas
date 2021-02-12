<?php

require __DIR__ . '/../vendor/autoload.php';

use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Canvas;
use DTL\ConsoleCanvas\Color;
use DTL\ConsoleCanvas\Element\Container;
use DTL\ConsoleCanvas\Element\Rectangle;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Stroke\Block;
use DTL\ConsoleCanvas\Stroke\Line;

$canvas = new Canvas(width: 120, height: 24);

$container = new Container(100, 30);

for ($i = 2; $i < 20; $i += 4) {
    $bar = new Rectangle(width: 4, height: $i, fill: true);
    $container->addAt(new Position($i, 0), $bar);

    $container->meta($bar)->setColor(Color::red());
    $container->meta($bar)->setFillColor(Color::green());
    $container->meta($bar)->setStroke(new Line());
    $container->meta($bar)->setFillStroke(new Block());
}

$container->render(Brush::default(), $canvas);

echo $canvas->render();
