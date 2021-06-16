<?php
require_once("Chest.php");
class GoldChest extends Chest {
    function execute(Player $player) {
        $min_score = $this->getMinScore();
        $max_core = $this->getMaxScore();

        $random_score = random_int($min_score, $max_core);
        $player->addScore($random_score);

        echo("[Room " . $player->getCurrentRoom()->uniqueNumber() . "] Игрок открыл " . $this->getName() . " и получает дополнительные очки: " . $random_score . "\n");
    }
}