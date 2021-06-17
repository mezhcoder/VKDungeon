<?php
require_once("Dungeon.php");

class Controller {
    private Dungeon $dungeon;
    private Player $player;
    private $isLoadedDungeon;

    public function __construct() {
        $this->dungeon = new Dungeon();
        $this->isLoadedDungeon = false;
    }

    public function loadDungeon($path_settingsFile) {
        echo("[Dungeon] Загрузка карты..\n");
        $this->dungeon->loadMap(file_get_contents($path_settingsFile));
        $this->player = $this->dungeon->getSpawnPlayer();
        $this->isLoadedDungeon = true;
        echo("[Dungeon] Спавн игрока в начальной комнате: " . strval($this->player->getCurrentRoom()->uniqueNumber()) . " || Доступные комнаты: " . implode(",", $this->dungeon->availableMovedRooms($this->player)) . "\n");
    }

    public function movedToRoom($numberRoom) {
        if ($this->player->isMovedToRoom($numberRoom, $this->dungeon)) {
            $lastNumberRoom = $this->player->getCurrentRoom()->uniqueNumber();
            $this->player->moveToRoom($numberRoom,  $this->dungeon);
            echo("[V] Персонаж был перемещён из комнаты " . $lastNumberRoom . " --> " . $this->player->getCurrentRoom()->uniqueNumber() . " || Доступные комнаты: " . implode(",", $this->dungeon->availableMovedRooms($this->player)) . "\n");
        } else {
            echo ("[X] Перемещение невозможно. Выберите одну из комнат: " . implode(",", $this->dungeon->availableMovedRooms($this->player))  .  "\n");
        }
    }

    public function isPlayerFoundExit() {
        return $this->player->getCurrentRoom()->uniqueNumber() == $this->dungeon->getEndRoom()->uniqueNumber();
    }

    public function isLoadedDungeon() {
        return $this->isLoadedDungeon;
    }

    public function getAvailableRoom() {
        return implode(",", $this->dungeon->availableMovedRooms($this->player));
    }
}