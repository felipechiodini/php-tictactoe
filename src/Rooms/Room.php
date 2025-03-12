<?php

namespace App\Rooms;

use App\Game\Game;

class Room
{
    public $id;
    public $game;
    public $players = [];

    public function __construct()
    {
        $this->id = 'aleratorio';
    }

    public function startNewGame()
    {
        $this->game = new Game(
            $this->players
        );
    }

    public function enter(Player $player)
    {
        $this->players[$player->id] = $player;

        if ($this->players === 2) {
            $this->startNewGame();
        }
    }

    public function hasSpace(): bool
    {
        return count($this->players) < 2;
    }
}