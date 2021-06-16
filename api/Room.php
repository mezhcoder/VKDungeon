<?php

class Room {
    private int $uniqueNumber;
    public $chests;
    private $bosses;

    public function __construct($uniqueNumber, $chests, $bosses) {
        $this->uniqueNumber = $uniqueNumber;
        $this->chests = $chests;
        $this->bosses = $bosses;
    }

    public function uniqueNumber(): int {
        return $this->uniqueNumber;
    }

    function execute($player) {
        foreach ($this->chests as $key => $item) {
            $item->execute($player);
            unset($this->chests[$key]);
        }
        foreach ($this->bosses as $key => $item) {
            $item->execute($player);
            unset($this->bosses[$key]);
        }
    }
}