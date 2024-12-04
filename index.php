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
    echo "Turno de {$game->turnOwner()}\n";

    $fin = fopen ("php://stdin","r");
    $value = fgets($fin);
    [$x, $y] = explode(" ", $value);

    $game->play($game->turnOwner(), (int) $x, (int) $y);
} while (true);
