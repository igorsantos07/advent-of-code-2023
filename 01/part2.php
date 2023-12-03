<?php
$lines = explode("\n", trim(file_get_contents('input.txt')));
$num = array_flip([
	1 => 'one',
	'two',
	'three',
	'four',
	'five',
	'six',
	'seven',
	'eight',
	'nine'
]);
$rnum = array_combine(array_map(static fn($k) => strrev($k), array_keys($num)), $num);

//option one: replace spelled out numbers
//problem: "oneight" at the end must be considered 8, not 1?
$start = microtime(true);
$sum = 0;
foreach ($lines as $line) {
	preg_match('/\d/', strtr($line, $num), $d1);
	preg_match('/\d/', strtr(strrev($line), $rnum), $d2);
	echo "$line (found {$d1[0]}{$d2[0]})\n";
	$sum += (int)"{$d1[0]}{$d2[0]}";
}
echo "Result: $sum";
$replace = microtime(true) - $start;
echo "\nReplace took ".$replace."ms\n\n";

//option two: preg_match + array replacement
//actually ignored because it would be too much trouble
