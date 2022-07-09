#!/usr/bin/env php
<?php

$outfile = 'videoid.txt';

$q = 'dog';
if(@$argv[1]) {
    $q = $argv[1];
}

$method = 'https://yts.pffy.dev/?q=' . $q;

$lines = [];
if(file_exists($outfile)) {

    $lines = explode(PHP_EOL, file_get_contents($outfile));
}

$json = json_decode(file_get_contents($method), true);
$arr = $json['items'];

foreach($arr as $a) {
    $lines[] = $a['id']['videoId'];
}

$uniq = array_unique($lines);

sort($uniq);
file_put_contents($outfile, trim(join(PHP_EOL, $uniq)) . PHP_EOL);
