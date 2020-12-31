<?php

require __DIR__ . '/../vendor/autoload.php';

use DTL\ConsoleCanvas\Canvas;
use DTL\ConsoleCanvas\Color;
use DTL\ConsoleCanvas\ElementMetadata;
use DTL\ConsoleCanvas\Element\Box;
use DTL\ConsoleCanvas\Element\Circle;
use DTL\ConsoleCanvas\Element\Container;
use DTL\ConsoleCanvas\Element\Series;
use DTL\ConsoleCanvas\Element\Text;
use DTL\ConsoleCanvas\Position;
use DTL\ConsoleCanvas\Brush;
use DTL\ConsoleCanvas\Stroke\Char;
use DTL\ConsoleCanvas\Stroke\Line;

$canvas = new Canvas(width: 120, height: 25, scaleY: 0.5);

$layer = new Container(100, 30);
$wave = fn(int $offset, int $scale = 10) => array_map(
    fn (float $radian) => sin($radian % 360) * $scale,
    range($offset, $offset + 359)
);
$series1 = new Series(
    $wave(0),
    step: 4
);
$series2 = new Series(
    $wave(0),
    step: 10
);
$series3 = new Series(
    $wave(0),
    step: 20,
    density: 20
);

$layer->addAt(new Position(0, 0), new Text(str_repeat('-', 200)));
$layer->addAt(new Position(0, 20), $series1);
$layer->addAt(new Position(0, 20), $series2);
$layer->addAt(new Position(0, 10), $series3);
$layer->addAt(new Position(0, 32), new Text(str_repeat('-', 200)));
$layer->addAt(new Position(0, 33), new Text(
    implode('', array_map(fn (int $num) => 0 === $num % 10 ? '|' : ' ', range(0, 200)))
));
$layer->addAt(new Position(0, 35), new Text(
    implode('', array_map(fn (int $num) => 0 === $num % 10 ? $num / 10 : ' ', range(0, 200)))
));

$layer->meta($series1)->setColor(Color::red());
$layer->meta($series2)->setColor(Color::blue());
$layer->meta($series3)->setColor(Color::green());
$layer->meta($series3)->setStroke(new Line());

$subLayer = new Container(100, 100);
$subLayer->addAt(new Position(0, 0), new Text('Hello'));
$layer->addAt(new Position(0, 0), $subLayer);

$brush = Brush::default();
$sleep = 10_000;
$offset = 0;
while (true) {
    $canvas->clear();
    $layer->render($brush, $canvas);
    echo $canvas->render();
    $offset += 1;
    $layer->meta($series1)->updateElement(fn (Series $s) => $s->withValues(
        $wave($offset)
    ));
    //$layer->meta($series2)->updateElement(fn (Series $s) => $s->withValues(
    //    $wave(-($offset + 90), 20)
    //));
    $layer->meta($series3)->updateElement(fn (Series $s) => $s->withValues(
        $wave($offset + 45)
    ));

    usleep($sleep);
}
