<?php
$lines = explode("\n", trim(file_get_contents('input.txt')));
$start = microtime(true);
$sum = array_reduce($lines, static function ($sum, $line) {
	preg_match('/\d/', $line, $d1);
	preg_match('/\d/', strrev($line), $d2);
	return $sum + (int)"{$d1[0]}{$d2[0]}";
}, 0);
echo "Result: $sum";
$reduce = microtime(true) - $start;
echo "\nReduce took ".$reduce."ms\n\n";

//foreach seems to be around 40% faster, let's chech
$start = microtime(true);
$sum = 0;
foreach ($lines as $line) {
	preg_match('/\d/', $line, $d1);
	preg_match('/\d/', strrev($line), $d2);
	$sum += (int)"{$d1[0]}{$d2[0]}";
}
echo "Result: $sum";
$foreach = microtime(true) - $start;
echo "\nForeach took ".$foreach."ms (".(round((($reduce/$foreach)-1)*100)).'% faster)';
