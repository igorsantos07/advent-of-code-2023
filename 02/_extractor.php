<?php
require_once '_classes.php';

$lines = explode("\n", trim(file_get_contents('input.txt')));
//$lines = explode("\n", trim(file_get_contents('control.txt')));

/** @var CubeGroup[][] $games */
return array_map(static function ($line) {
	preg_match('/Game (?<index>\d+):/', $line, $match);
	$game = new Game((int)$match['index']);
	$draws = explode(';', substr($line, strpos($line, ':')));
	foreach ($draws as $draw) {
		$cubes = array_reduce(explode(',', $draw), static function ($list, $cube) {
			//as a bonus, the regex allows us to skip trimming the strings
			preg_match('/(?<count>\d+) (?<color>\w)/', $cube, $pieces);
			$list[$pieces['color']] = $pieces['count'];
			return $list;
		}, []);
		$revealed = new CubeGroup($cubes['r'] ?? 0, $cubes['g'] ?? 0, $cubes['b'] ?? 0);
		$game->draw($revealed);
	}
//	echo $game."\n";
	return $game;
}, $lines);
