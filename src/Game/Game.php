<?php

namespace App\Game;

class Game
{
    public $board;
    public $players;

    public function __construct(array $players)
    {
        $this->board = new Board();
        $this->players = $players;
    }

    public function hasPlayerCircle(): bool
    {
        return isset($this->player1);
    }

    public function setPlayerCircle(string $id)
    {
        $this->player1 = new Player($id, new Circle());
    }

    public function setPlayerTimes(string $id)
    {
        $this->player2 = new Player($id, new Times());
    }

    public function setPlayer(string $id)
    {
        rand(0, 1) ? $this->setplayerTimes($id) : $this->setPlayerCircle($id);
    }

    public function removePlayer(string $id)
    {
        if (@$this->player1->id === $id) {
            $this->player1 = null;
        }

        if (@$this->player2->id === $id) {
            $this->player2 = null;
        }
    }

    public function play(string $playerId, int $row, int $col)
    {
        if ($this->turnOwner()->id !== $playerId) {
            throw new \Exception('Not your turn');
        }

        $this->board->fillSpace($row, $col, $this->turnOwner());

        if ($this->board->checkWin($this->turnOwner())) {
            die("Winner is {$this->turnOwner()}");
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
}