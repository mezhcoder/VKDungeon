<?php
require_once("api/Controller.php");

$controller = new Controller();
$controller->loadDungeon("files/settings.json");
$controller->movedToRoom(5);
$controller->movedToRoom(1);