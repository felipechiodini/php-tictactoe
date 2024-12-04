<?php

namespace App;

class PlayGame
{
    private $game;

    public function __construct(Game $game)
    {
        $this->game = $game;
    }
}