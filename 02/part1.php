<?php
require_once '_classes.php';

class Game extends BaseGame {

	public function isPossible(int $r, int $g, int $b): bool {
		foreach ($this->draws as $draw) {
			if ($draw->r > $r || $draw->g > $g || $draw->b > $b) {
				return false;
			}
		}
		return true;
	}
}

$games = require('_extractor.php');
$possible = array_filter($games, static fn (Game $game) => $game->isPossible(12, 13, 14));
echo array_sum(array_map(fn(Game $game)=> $game->index, $possible));
