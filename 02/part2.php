<?php
require_once '_classes.php';

class Game extends BaseGame {

	public function minimumCubes(): CubeGroup {
		$min = new CubeGroup(0, 0, 0);
		foreach ($this->draws as $draw) {
			foreach ($min as $color => $_) {
				if ($draw->{$color} > $min->{$color}) {
					$min->{$color} = $draw->{$color};
				}
			}
		}
		return $min;
	}
}

/** @var Game[] $games */
$games = require('_extractor.php');
echo array_sum(array_map(fn(Game $game)=> $game->minimumCubes()->power(), $games));
