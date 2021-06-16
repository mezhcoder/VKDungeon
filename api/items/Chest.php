<?php

abstract class Chest {
    private string $name;
    private int $min_score;
    private int $max_score;

    public function __construct(int $min_score, int $max_score, string $name) {
        $this->name = $name;
        $this->min_score = $min_score;
        $this->max_score = $max_score;
    }

    function getMinScore() {
        return $this->min_score;
    }
    function getMaxScore() {
        return $this->max_score;
    }
    function getName() {
        return $this->name;
    }

    abstract function execute(Player $player);
}