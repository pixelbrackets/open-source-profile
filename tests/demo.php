<?php

require __DIR__ . '/../vendor/autoload.php';

$title = \Pixelbrackets\OpenSourceProfile\ProfileApp::getTitle();

echo PHP_EOL . '*Title*' . PHP_EOL;
echo '* ' . $title;
