<?php

class Map {
    private array $rooms = array();

    public function addRoom(Room $room) {
        $this->rooms[$room->uniqueNumber()] = $room;
    }

    public function getRoom(int $number) {
        return $this->rooms[$number];
    }
}