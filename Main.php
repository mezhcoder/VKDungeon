<?php
require_once("api/Controller.php");

$controller = new Controller();
$controller->loadDungeon("files/settings.json");
$controller->movedToRoom(5);
$controller->movedToRoom(6);
$controller->movedToRoom(10);
$controller->movedToRoom(6);
$controller->movedToRoom(2);
$controller->movedToRoom(6);
$controller->movedToRoom(7);
$controller->movedToRoom(8);