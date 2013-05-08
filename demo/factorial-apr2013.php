<?php

require __DIR__ . '/../vendor/autoload.php';

use SeaPhp\Apr2013\Math;

foreach (range(0, 5) as $num) {
    echo Math::factorial($num) . PHP_EOL;
}
