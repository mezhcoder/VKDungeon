<?php
require_once("Boss.php");
class EasyBoss extends Boss {
    function execute(Player $player) {
        echo("[Room " . $player->getCurrentRoom()->uniqueNumber() . "] Игрок наткнулся на босса " . $this->getName() . "\n");
        echo("[Fight] Пусть победит сильнейший!" . "\n");

        $round = 1;
        $damageBoss = $this->getStartDamage();
        $damagePlayer = random_int(0, 30);
        while (true) {
            echo("[Round $round] сила босса: $damageBoss @===@ сила игрока: $damagePlayer\n");
            if ($damagePlayer > $damageBoss) {
                echo ("[Round $round] Игрок выиграл сражение! Он получает дополнительные очки: " . $this->getRewardScore() . "\n");
                $player->addScore($this->getRewardScore());
                break;
            }
            $round += 1;
            $damageBoss -= $this->getLossDamage();
            $damagePlayer = random_int(0, 30);
        }
    }
}