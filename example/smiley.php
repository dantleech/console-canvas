<?php

require __DIR__ . '/../vendor/autoload.php';

use DTL\ConsoleCanvas\Canvas;
use DTL\ConsoleCanvas\Color;
use DTL\ConsoleCanvas\ElementMetadata;
use DTL\ConsoleCanvas\Element\Box;
use DTL\ConsoleCanvas\Element\Circle;
use DTL\ConsoleCanvas\Element\Container;
use DTL\ConsoleCanvas\Element\Text;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Stroke\Line;

$canvas = new Canvas(width: 100, height: 25, scaleY: 0.5);
$circle = new Circle(radius: 10);
$box1 = new Box(size: 30);
$box2 = new Box(size: 10);
$box3 = new Box(size: 10);
$text = new Text('Smile!');

$container = new Container(20, 30);
$container->addAt(new Position(10, 0), $box1);
$container->addAt(new Position(50, 0), $box2);
$container->addAt(new Position(5, 5), $box3);
$container->addAt(new Position(0, 0), $circle);
$container->addAt(new Position(7, 10), $text);
$container->meta($box1)->setColor(Color::red());
$container->meta($box2)->setColor(Color::green());
$container->meta($circle)->setColor(Color::yellow());
$container->meta($circle)->setStroke(new Line());
$brush = Brush::default();

$container->render($brush, $canvas);
$sleep = 40_000;
while (true) {
    for ($x = 0; $x < 50; $x++) {
        usleep($sleep);
        $canvas->clear();
        $container->meta($circle)->updatePosition(
            fn (Position $p) => $p->withX($p->x() + 1)
        );
        $container->meta($text)->updatePosition(
            fn (Position $p) => $p->withX($p->x() + 1)
        );
        $container->render($brush, $canvas);
        echo($canvas->render());
    }
    for ($x = 0; $x < 50; $x++) {
        usleep($sleep);
        $canvas->clear();
        $container->meta($circle)->updatePosition(
            fn (Position $position) => new Position($position->x() - 1, $position->y())
        );
        $container->meta($text)->updatePosition(
            fn (Position $position) => new Position($position->x() - 1, $position->y())
        );
        $container->render($brush, $canvas);
        echo($canvas->render());
    }
}

