<?php
require_once("Dungeon.php");



class Controller {
    public Dungeon $dungeon;
    public Player $player;

    public function __construct() {
        $this->dungeon = new Dungeon();
    }

    public function loadDungeon($path_settingsFile) {
        echo("[Dungeon] Загрузка карты..\n");
        $this->dungeon->loadMap(file_get_contents($path_settingsFile));
        $this->player = $this->dungeon->getSpawnPlayer();

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
}