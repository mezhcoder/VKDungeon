<?php
require_once("api/Controller.php");

$controller = new Controller();
while (true) {
    if ($controller->isLoadedDungeon()) {
        if ($controller->isPlayerFoundExit()) {
            break;
        }
    }

    $args = explode(" ", trim(fgets(STDIN)));
    if (!isset($args[0])) return;
    switch ($args[0]) {
        case "dungeon":
            if ($args[1] == "load") {
                if (!is_dir($args[2]) and is_file($args[2])) {
                    $controller->loadDungeon($args[2]);
                } else {
                    echo("[DungeonAPI] К сожалению, невозможно конфигурацию по пути $args[2]\n");
                }
            } else {
                echo("[DungeonAPI] К сожалению, нет такой метода как $args[1]\n");
            }
            break;
        case "move":
            if(!$controller->isLoadedDungeon()) {
                echo("[DungeonAPI] Для начала загрузите подземелье. Запрос: dungeon load путь_к_конфигурации\n");
                break;
            }

            if (isset($args[1]) and is_numeric($args[1])) {
                $controller->movedToRoom(strval($args[1]));
            } else {
                echo("[DungeonAPI] Невозможно получить номер комнаты.\n");
            }
            break;
        case "availableRooms":
            if(!$controller->isLoadedDungeon()) {
                echo("[DungeonAPI] Для начала загрузите подземелье. Запрос: dungeon load путь_к_конфигурации\n");
                break;
            }
            echo ("[DungeonAPI] Доступные комнаты: " . $controller->getAvailableRoom() . "'n");
            break;
        default:
            echo("[DungeonAPI] К сожалению нет такого метода в API\n");
    }
}