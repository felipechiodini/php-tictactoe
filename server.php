<?php

require 'vendor/autoload.php';

use App\Board;
use App\Circle;
use App\Game;
use App\Player;
use App\Times;

$player1 = new Player(new Circle);
$player2 = new Player(new Times);

$game = new Game(
    new Board(),
    $player1,
    $player2
);

do {
    try {
        $game->askForPlay();
    } catch (\Throwable $th) {
        echo $th->getMessage() . PHP_EOL;
    }
} while (true);
