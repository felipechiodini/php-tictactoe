<?php

namespace App\Game;

class PlayGame
{
    private $game;

    public function __construct(Game $game)
    {
        $this->game = $game;
    }
}