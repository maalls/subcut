<?php

include __DIR__ . "/lib/Srt.php";
$filename = $argv[1];
$offset = $argv[2];
$from = $argv[3];

$srt = new Srt();

$srt->load($filename);
$srt->offset($offset, $from);
$srt->print();
//var_dump($matches);

//echo $content . PHP_EOL;


