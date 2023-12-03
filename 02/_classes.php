<?php
//originally "RevealedCubes" before part 2
class CubeGroup {
	public int $r;
	public int $g;
	public int $b;

	public function __construct(int $r = 0, int $g = 0, int $b = 0) {
		$this->r = $r;
		$this->g = $g;
		$this->b = $b;
	}

	public function __toString() { //added in P2 for development checking
		$valid = array_filter((array)$this);
		return implode(', ', array_map(fn($c)=> $valid[$c].$c, array_keys($valid)));
	}

	public function power() { //added in P2
		return $this->r * $this->g * $this->b;
	}
}

abstract class BaseGame {

	public int $index;

	/** @var CubeGroup[] */
	protected array $draws = [];

	public function __construct(int $index) { $this->index = $index; }

	public function draw(CubeGroup $cubes): void {
		$this->draws[] = $cubes;
	}

	public function __toString() {
		return "Game $this->index: ".implode('; ', $this->draws);
	}
}
