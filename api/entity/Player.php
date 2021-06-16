<?php


class Player {
    private Room $positionRoom;
    private int $score = 0;

    public function __construct($startRoom) {
        $this->positionRoom = $startRoom;
    }

    public function getCurrentRoom() {
        return $this->positionRoom;
    }

    public function moveToRoom(int $numberRoom, Dungeon $dungeon) {
        if (!$dungeon->isMovedToRoom($this, $numberRoom)) return;
        $this->positionRoom = $dungeon->getMap()->getRoom($numberRoom);
        $this->getCurrentRoom()->execute($this);

        if ($dungeon->getEndRoom()->uniqueNumber() == $this->positionRoom->uniqueNumber()) {
            echo("[Room " . $this->positionRoom->uniqueNumber() . "] Поздравляем! Игрок нашёл выход!\n");
            echo("[Dungeon] Прохождение закончено. Итоговые очки игрока: " . $this->score . "\n");
            exit(0);
        }
    }

    public function isMovedToRoom(int $numberRoom, Dungeon $dungeon) {
        return $dungeon->isMovedToRoom($this, $numberRoom);
    }

    public function getScore() : int {
        return $this->score;
    }

    public function addScore(int $number) {
        return $this->score += $number;
    }
}