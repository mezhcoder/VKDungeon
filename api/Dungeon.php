<?php

function includeFiles($dir) {
    $catalog = opendir($dir);

    while ($filename = readdir($catalog )) { // перебираем наш каталог {
        $filename = $dir."/".$filename;
        if (!is_dir($filename)) {
            include_once($filename); // один раз подрубаем, чтоб не повторяться
        }
    }
    closedir($catalog);
}

require_once("Map.php");
require_once("Room.php");
includeFiles("api/entity/");
includeFiles("api/items/");

function createRoom($numberRoom, $json) {
    $chests = [];
    $bosses = [];

    //add chests
    foreach ($json["chests"] as $key => $value) {
        if (in_array($numberRoom, $value["spawnRooms"])) {
            switch ($key) {
                case "WoodChest":
                    $chests[] = new WoodChest($value["min_score"], $value["max_score"], "WoodChest");
                    break;
                case "IronChest":
                    $chests[] = new IronChest($value["min_score"], $value["max_score"], "IronChest");
                    break;
                case "GoldChest":
                    $chests[] = new GoldChest($value["min_score"], $value["max_score"], "GoldChest");
                    break;
            }
        }
    }

    //add bosses  //spawnRooms
    foreach ($json["bosses"] as $key => $value) {
        if (in_array($numberRoom, $value["spawnRooms"])) {
            switch ($key) {
                case "EasyBoss":
                    $bosses[] = new EasyBoss($value["startDamage"], $value["lossDamage"], $value["rewardScore"], "EasyBoss");
                    break;
                case "MiddleBoss":
                    $bosses[] = new MiddleBoss($value["startDamage"], $value["lossDamage"], $value["rewardScore"], "EasyBoss");
                    break;
                case "HardBoss":
                    $bosses[] = new HardBoss($value["startDamage"], $value["lossDamage"], $value["rewardScore"], "EasyBoss");
                    break;
            }
        }
    }

    return new Room($numberRoom, $chests, $bosses);
}
function loadMap($map, $json) {
    foreach ($json["map"] as $line) {
        $data_rooms = explode(" ", $line);
        foreach ($data_rooms as $numberRoom) {
            $room = createRoom($numberRoom, $json);
            $map->addRoom($room);
        }
    }
}


class Dungeon {
    private Map $map;

    private Room $startRoom;
    private Room $endRoom;

    public array $aisleRooms = array();

    function loadMap($json_settingsFile) {
        $json = json_decode($json_settingsFile, true);;

        $this->map = new Map();
        loadMap($this->map, $json);

        $this->startRoom = $this->map->getRoom($json["startRoom"]);
        $this->endRoom = $this->map->getRoom($json["endRoom"]);

        foreach ($json["edges"] as $key => $value)
            $this->aisleRooms[$key] = $value;
    }


    function getSpawnPlayer() {
        $player = new Player($this->startRoom);
        $player->getCurrentRoom()->execute($player);;
        return $player;
    }

    function availableMovedRooms(Player $player) {

        return $this->aisleRooms[$player->getCurrentRoom()->uniqueNumber()];
    }

    function getMap() {
        return $this->map;
    }

    function isMovedToRoom(Player $player, $to_numberRoom) {
        if (isset($this->aisleRooms[$player->getCurrentRoom()->uniqueNumber()])) {
            if (in_array($to_numberRoom, $this->aisleRooms[$player->getCurrentRoom()->uniqueNumber()])) {
                return true;
            }
        }

        return false;
    }

    public function getStartRoom() {
        return $this->startRoom;
    }

    public function getEndRoom() {
        return $this->endRoom;
    }
}
