<?php

namespace App;

class Game
{
    private $board;
    private $player1;
    private $player2;
    private $turn = true;

    public function __construct(Board $board, Player $player1, Player $player2)
    {
        $this->board = $board;
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    public function play(Player $player, int $row, int $col)
    {
        if ($this->turnOwner() !== $player) {
            throw new \Exception('Not your turn');
        }

        $this->board->fillSpace($row, $col, $player);

        if ($this->board->checkWin($player)) {
            die("Winner is {$player}");
        }

        $this->toogleTurn();
    }

    public function turnOwner(): Player
    {
        if ($this->turn === true) {
            return $this->player1;
        } else {
            return $this->player2;
        }
    }

    public function toogleTurn()
    {
        $this->turn = !$this->turn;
    }

    public function askForPlay()
    {
        echo "Turno de {$this->turnOwner()}\n";

        try {
            $fin = fopen ("php://stdin","r");
            $value = fgets($fin);
            [$x, $y] = explode(" ", $value);

            print_r([$x, $y]);
        } catch (\Throwable $th) {
            throw new \Exception("Ocorreu um erro ao ler a posição, tente novamente");
        }

        $this->play($this->turnOwner(), (int) $x, (int) $y);
    }
}