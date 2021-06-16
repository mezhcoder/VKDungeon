<?php

abstract class Boss {
    private string $name;

    private int $startDamage;
    private int $lossDamage;
    private int $rewardScore;

    public function __construct(int $startDamage, int $lossDamage, int $rewardScore,  string $name) {
        $this->name = $name;
        $this->startDamage = $startDamage;
        $this->lossDamage = $lossDamage;
        $this->rewardScore = $rewardScore;
    }

    public function getStartDamage() {
        return $this->startDamage;
    }

    public function getLossDamage() {
        return $this->lossDamage;
    }

    public function getRewardScore() {
        return $this->rewardScore;
    }

    public function getName() {
        return $this->name;
    }

    abstract function execute(Player $player);
}